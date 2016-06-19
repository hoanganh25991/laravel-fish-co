@extends("layouts.app")
@section("content")
    <div class="col-md-12 col-xs-12" id="welcome">
        <div class="text-center">
            <h1>Fish & Co</h1>
            <p>Sea food in Japan</p>
            <h3>Whale-come to Global Fish & Co.!</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate</p>
            <button class="btn btn-default btn-lg" id="btnGlobalFishCo">GlobalFISHCO</button>
        </div>
    </div>

    <div class="col-md-12 col-xs-12" id="play">
        <form class="form-group" method="POST" action="" id="submissionForm" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="file" name="submission_image" class="form-control" required>
            <label for="name">name</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input type="text" name="caption" class="form-control" id="name">
            </div>
            <label for="email">email</label>
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <label for="contact_number">contact number</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </span>
                <input type="text" name="contact_number" class="form-control" id="contact_number" required>
            </div>
            {{--for demo, hard code on options--}}
            <label for="country_id">country</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                </span>
                <select name="country_id" class="form-control" id="country_id">
                    <option value="1">Singapore</option>
                    <option value="2">Brunei</option>
                    <option value="3">Malaysia</option>
                    <option value="4">Vietnam</option>
                    <option value="5">India</option>
                </select>
            </div>
            <div>
                <div class="checkbox">
                    <label for="mailing_list">
                        <input type="checkbox" name="mailing_list" value="true" id="mailing_list">
                        Sign me up for mailing list
                    </label>
                </div>
                <div class="checkbox">
                    <label for="term_condition">
                        <input type="checkbox" name="term_condition" id="term_condition">
                        I've read the <a href="https://google.com.vn">terms & conditions</a>
                    </label>
                </div>
            </div>
            <input type="submit" id="btnSubmit" value="Submit Now!" class="btn btn-default btn-block">
        </form>
    </div>
    <script type="application/javascript">
        (function($){
            var logRes = function(res, statusText, xhr){
                var status = xhr.status;
                console.log(status);
                console.log(res);
                console.log(JSON.parse(res))
            };
            /**
             * verify device.serial_number
             */
            $.get("token", function(token){
                var data = {
                    "serial_number": "F9:32:28:15:88:13",
                    "_token": token
                };
                $.ajax({
                    url: "candidate/verify",
                    method: "post",
                    data: data,
                    statusCode: {
                        200: logRes
                    }
                });
            });
            var file;
            $("input[name='submission_image']").on("change", function(e){
                console.log(e);
                file = e.target.files[0];
            });

            $("#submissionForm").on("submit", function(e){
                e.preventDefault();
                var formData = new FormData($(this)[0]);
//                formData.append("submission_image", file);
                formData.append("serial_number", "F9:32:28:15:88:13");
                var oReq = new XMLHttpRequest();
                oReq.open("POST", "submission/create");
                oReq.send(formData);
                oReq.onload = function(){
                    console.log(oReq.status);
                    console.log(oReq.response);
                };
            });
        })(jQuery);
    </script>
@endsection