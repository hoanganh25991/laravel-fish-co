<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Device;
use App\Image;
use App\Submission;
use App\SubmissionImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;

class SubmissionController extends Controller{
    const WARNING = "sorry, we still not handle this situation";

    public function create(Request $request){
        /**
         * validate
         */
        $validator = Validator::make($request->all(), [
            SubmissionImage::TABLE => "bail|required",
            Candidate::CONTACT_NUMBER => "bail|required",
        ]);

        if($validator->fails()){
            return Response::json($validator->getMessageBag()->toArray(), 422);
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
                }

                if($device){
                    if($device->candidate->id != $candidate->id){
                        /**
                         * he borrow phone from some one
                         * NOT ALLOW
                         */
                        return Response::json([Candidate::TABLE => $device->candidate->toArray()], 418);
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
                 * check type
                 */
                $validator = Validator::make($imageFile, [
//                    "type" => "bail|image",
//                    "type" => "bail|mimes:jpeg,jpg,png",
"size" => "bail|max:{$image->maxFileSize()}",
                ]);
                if($validator->fails()){
                    return Response::json([
                        $validator->getMessageBag()->toArray(),
                        "type" => $imageFile["type"]
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
                        return Response::json(["hello" => "world"]);
                    }else{
                        /**
                         * can not move file
                         * permission/ect
                         */
                        return Response::json([Image::TABLE => $imageFile], 421);
                    }
                }
            }

            if($imageFile["error"] > 0){
                return Response::json([Image::TABLE => $imageFile], 419);
            }
//            $image = new Image($request->all());


//            return json_encode(["hello" => "world"]);
        }
        return json_encode(self::WARNING);
    }
}
