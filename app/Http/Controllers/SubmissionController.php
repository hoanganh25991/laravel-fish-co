<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Device;
use App\Image;
use App\Submission;
use App\SubmissionImage;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;

use stdClass;

class SubmissionController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";

    public function create(Request $request){
        /**
         * validate
         */
        $validator = Validator::make($request->all(), [
            SubmissionImage::TABLE => "bail|required",
            Candidate::CONTACT_NUMBER => "bail|required",
        ]);

        if($validator->fails()){
            return Response::json([
                self::STATUS_CODE => 422,
                self::STATUS_MSG => "validate fail",
                self::DATA => $validator->getMessageBag()->toArray()
            ], 422);
        }

        if(!$validator->fails()){
            /**
             * contact number is IDENTIFIER
             * base on contact number, define candidate
             */
            $candidate =
                Candidate::with("device")->where(Candidate::CONTACT_NUMBER, $request->get(Candidate::CONTACT_NUMBER))
                    ->first();

            if(!$candidate){
                $candidate = new Candidate($request->all());
                $candidate->save();
                $device = new Device($request->all());
                /** @var Device::DES wait for future info */
                $device->candidate_id = $candidate->id;
                $device->save();
            }

            if($candidate){
                /**
                 * check Device in database from request, serial number
                 */
                $serialNumber = $request->get(Device::SERIAL_NUMBER);
                $device = Device::with("candidate")->where(Device::SERIAL_NUMBER, $serialNumber)->first();
                /**
                 * !$device > complete new
                 */
                if(!$device){
                    $device = new Device($request->all());
                    $device->candidate_id = $candidate->id;
                    $device->save();

                    /**
                     * update candidate info (name)
                     */
                    $candidate->fill($request->all());
                    $candidate->save();
                }

                if($device){
                    if($device->candidate->id != $candidate->id){
                        /**
                         * he borrow phone from some one
                         * NOT ALLOW
                         */
                        return Response::json([
                            self::STATUS_CODE => 418,
                            self::STATUS_MSG => "borrow phone, device not belongsTo contact_number",
                            self::DATA => $device->candidate->toArray()
                        ], 418);
                    }
                }
            }


            /**
             * create Submission
             */
            /**
             * handle image
             * {"name":"678085-house-128.png","type":"image\/png","tmp_name":"C:\\Users\\hoanganh25991\\AppData\\Local\\Temp\\phpE453.tmp","error":0,"size":2762}
             */
            $imageFile = $_FILES[SubmissionImage::TABLE];
//            return json_encode($imageFile);
            if($imageFile["error"] == 0){
                $image = new Image();
                /**
                 * check image type by HAND
                 * bcs we has modified on FILE by FormData
                 * >no signature (encrypt=multiparr/form-data)
                 */
//                $isImaged = exif_imagetype($imageFile["tmp_name"]);
//                dd($isImaged);
//                if($isImaged){
//                    return Response::json(["isImage" => $isImaged]);
//                }
//                if(!$isImaged){
//                    return Response::json([Image::TABLE => "{$imageFile["name"]} is not an image"], 423);
//                }
                /**
                 * PUSH custom validator in to Image@isImage
                 * ^^ cool right
                 */
                $validator = Validator::make($imageFile, [
//                    "tmp_name" => "bail|image|mimes:jpeg,jpg,png",
"tmp_name" => "bail|isImage",
//                    "type" => "bail|mimes:jpeg,jpg,png",
"size" => "bail|max:{$image->maxFileSize()}",
                ]);
                if($validator->fails()){
                    return Response::json([
                        self::STATUS_CODE => 420,
                        self::STATUS_MSG => "uploaded image, validate fail",
                        self::DATA => $validator->getMessageBag()->toArray()
                    ], 420);
                }
                if(!$validator->fails()){
                    /**
                     * move from temp to /public/upload/
                     */
                    $fileNameWithExt = $imageFile["name"];

                    /**
                     * check if file path already exist
                     */
                    $fileName = md5(pathinfo($fileNameWithExt, PATHINFO_FILENAME));
                    $tmpName = $fileName;
                    $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
                    /**
                     * make sure NOT SPACE in file name
                     * change fileNameWithExt base on md5
                     */
                    $fileNameWithExt = "{$fileName}.{$extension}";
                    $outputDir = env("UPLOAD_FOLDER");
                    if(!is_dir($outputDir) && !file_exists($outputDir)){
                        mkdir($outputDir, 777, true);
                    }
                    $i = 0;
                    while(file_exists($outputDir . DIRECTORY_SEPARATOR . $fileName . "." . $extension)){
                        $fileName = "{$tmpName}_{$i}";
                        $fileNameWithExt = "{$fileName}.{$extension}";
                        $i++;
                    }
                    $imagePath = $outputDir . DIRECTORY_SEPARATOR . $fileNameWithExt;
                    $tmpFileMoved =
                        move_uploaded_file($imageFile["tmp_name"], $outputDir . DIRECTORY_SEPARATOR . $fileNameWithExt);
                    if($tmpFileMoved){
                        $image->fill($request->all());
                        $image->fill($imageFile);
                        $image->path = $imagePath;
                        $image->save();

                        $submission = new Submission($request->all());
                        $submission->candidate_id = $candidate->id;
                        $submission->save();

                        $sI = new SubmissionImage();
                        $sI->image_id = $image->id;
                        $sI->submission_id = $submission->id;
                        $sI->save();
                        return Response::json([
                            self::STATUS_CODE => 200,
                            self::STATUS_MSG => "success create submission",
                        ]);
                    }else{
                        /**
                         * can not move file
                         * permission/ect
                         */
                        return Response::json([
                            self::STATUS_CODE => 421,
                            self::STATUS_MSG => "can not move file",
                            self::DATA => $imageFile
                        ], 421);
                    }
                }
            }

            if($imageFile["error"] > 0){
                return Response::json([
                    self::STATUS_CODE => 419,
                    self::STATUS_MSG => "file upload error",
                    self::DATA => $imageFile
                ], 419);
            }
//            $image = new Image($request->all());


//            return json_encode(["hello" => "world"]);
        }
        return json_encode(self::WARNING);
    }

    public function index(Request $request){
        /**
         * base on serial number of device
         * >find out candidate & his submission
         */
        $serialNumber = $request->get(Device::SERIAL_NUMBER);
        /**
         * @warn load device > candidate > submission
         * what if device > candidate but candidate =  null
         */
        $candidate = Device::with("candidate.submission")->where(Device::SERIAL_NUMBER, $serialNumber)->first();
        if(!$candidate){
            return json_encode(new stdClass);
        }
        if($candidate){
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success load submission base on candidate",
                self::DATA => $candidate->toArray()
            ], 200);
        }
        return json_encode(self::WARNING);
    }

    public function byCountry(Request $request){
//        $request->
        /**
         * handle for POST
         */
        $country_id = $request->get(Submission::COUNTRY_ID);
        $serialNumber = $request->get(Device::SERIAL_NUMBER);
        $candidate = Device::with([
            "candidate.submission" => function ($query) use ($country_id){
                $query->where(Submission::COUNTRY_ID, $country_id);
            }
//"candidate" => function ($query) use ($country_id){
//    $query->with([
//        "submission" => function ($query) use ($country_id){
//            $query->where(Submission::COUNTRY_ID, $country_id);
//        }
//    ]);
//}
            /**
             * clouse function $query is actually Relation $hasOne|$hasMany
             */
//            "candidate" => function(Relation $hasMany) use ($country_id){
//                $hasMany->with([
//                    "submission" => function(Relation $hasMany) use($country_id){
//                        $query = $hasMany->getQuery();
//                        $query->where(Submission::COUNTRY_ID, $country_id);
////                        dd($query);
//                    }
//                ]);
//            }
        ])->where(Device::SERIAL_NUMBER, $serialNumber)->first();

        if(!$candidate){
//            return json_encode(new stdClass);
            return Response::json([
                self::STATUS_CODE => 424,
                self::STATUS_MSG => "no submission base on candidate and country"
            ]);
        }

        if($candidate){
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success load submission by candidate and country",
                self::DATA => $candidate->toArray()
            ], 200);
        }
//        return json_encode(self::WARNING);
        return Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => self::WARNING
        ]);
    }
}
