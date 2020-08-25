<?php

if (!function_exists('echoCaptcha')) {

    function echoCaptcha() {
        return "<div class='form-group'>  
                <label class='control-label col-md-3 col-sm-3 col-xs-12'>
                </label>
                    <script nonce='S51U26wMQz' type='text/javascript' src='https://www.google.com/recaptcha/api.js' async defer></script>
                    <script nonce='S51U26wMQz' type='text/javascript'>
                        function enableLogin() {                                            
                            document.getElementById('btnLogin').disabled = false;
                        }
                    </script>                    
                    <div class='g-recaptcha col-md-6 col-sm-6 col-xs-12' style='' data-sitekey='6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo' data-callback='enableLogin'></div>                                                           
            </div>";
    }

}

if (!function_exists('successOrErrorMessage')) {

    function successOrErrorMessage($message, $type) {
        $_SESSION[$type] = 1;
        $_SESSION['message'] = $message;
    }

}

function set_selected($desired_value, $new_value) {
    if ($desired_value == $new_value) {
        $str = ' selected="selected" ';
        return $str;
    } else {
        return '';
    }
}

function set_cheked($desired_value, $new_value) {
    if ($desired_value == $new_value) {
        $str = ' checked ';
        return $str;
    } else {
        return '';
    }
}

function reCaptchaResilt($captcha_entered, $redirect_url) {
    if ($captcha_entered != $_SESSION['rand_code']) {
        $_SESSION['captcha'] = 1;
        return redirect()->to($redirect_url);
    }
    return true;
}

function visitLog($method, $controller) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $userType = $_SESSION['usertype'];
        log_message('info', "$userType id $userId visit the $controller controller and method name is $method");
    } else {
        log_message('info', "guest user visit the $controller controller and method name is $method");
    }
}

function lasturl() {
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else
        $link = "http";

// Here append the common URL characters. 
    $link .= "://";

// Append the host(domain name, ip) to the URL. 
    $link .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL 
    $link .= $_SERVER['REQUEST_URI'];

// Print the link 
    return $link;
}

function sessionAdmin($row) {
    foreach ($row as $key => &$value) {
        $_SESSION[$key] = $value;
    }
    $_SESSION['user_id'] = $row['admin_user_id'];
    $_SESSION['usertype'] = 'admin';
    $_SESSION['lastULR'] = BASE_URL . $_SERVER['REQUEST_URI'];      
    return true;
}
function sessionCheckAdmin() {
    if ((!isset($_SESSION['admin_user_id'])) || !isset($_SESSION['usertype'])) {
        session_destroy();
        header('Location: ' . ADMIN_LOGIN_LINK);
        exit();
    }
    if (isset($_SESSION['usertype'])) {
        if ($_SESSION['usertype'] != 'admin') {
            session_destroy();
            header('Location: ' . ADMIN_LOGIN_LINK);
            exit();
        }
    }
    return true;
}

function sessionEmployee($row) {
    foreach ($row as $key => &$value) {
        $_SESSION[$key] = $value;
    }
    $_SESSION['user_id'] = $row['employee_user_id'];
    $_SESSION['usertype'] = 'employee';    
    return true;
}

function sessionCheckEmployee() {
    if (!isset($_SESSION['employee_user_id']) || !isset($_SESSION['usertype'])) {
        session_destroy();
        header('Location: ' . EMPLOYEE_LOGIN_LINK);
        exit();
    }
    if (isset($_SESSION['usertype'])) {
        if ($_SESSION['usertype'] != 'employee') {
            session_destroy();
            header('Location: ' . EMPLOYEE_LOGIN_LINK);
            exit();
        }
    }
    return true;
}

function generateToken() {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited
    for ($i = 0; $i < 10; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }
    return $token;
}

function sessionDestroy() {
    session_destroy();
}

/*

 * ***********************************************************************************

 * VIDEO UPLOAD START

 * ***********************************************************************************

 */


if (!function_exists('singleVideoUpload')) {

    function singleVideoUpload($file_tag) {

        $file_ary = $_FILES[$file_tag];

        return videoUpload($file_ary);
    }

}

if (!function_exists('multiVideoUpload')) {

    function multiVideoUpload($file_tag) {

        //print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

        //print_r($file_ary);die;

        $output_array = array();

        foreach ($file_ary as $file) {

            array_push($output_array, videoUpload($file));
        }

        return $output_array;
    }

}



if (!function_exists('videoUpload')) {

    function videoUpload($file) {

        //If directory doesnot exists create it.

        $data = array();

        $output_dir = IMG_DIR;
        $output_subdir = $output_dir . "video/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "WEBM", "webm",
                "MPG", "mpg",
                "MP2", "mp2",
                "MPEG", "mpeg",
                "MPE", "mpe",
                "MPV", "mpv",
                "OGG", "ogg",
                "MP4", "mp4",
                "M4P", "m4p",
                "M4V", "m4v",
                "AVI", "avi",
                "WMV", "wmv",
                "MOV", "mov",
                "QT", "qt",
                "FLV", "flv",
                "SWF", "swf"
            );
            //echo $file_ext;die;       
            if (in_array($file_ext, $expensions) === false) {

                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            if ($file_size > 104857600) {
                $errors[] = 'File size must be less than 100 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

//                $path_size = array(
//                    array('path' => $output_subdir1 . $NewImageName, 'size' => 500),
//                    array('path' => $output_subdir2 . $NewImageName, 'size' => 300),
//                    array('path' => $output_subdir3 . $NewImageName, 'size' => 100)
//                );
//                if (imageResizeLib($file_tmp, $filepath_original, $path_size)) {
                if (move_uploaded_file($file_tmp, "$filepath_original")) {
                    $data["video_name"] = $NewImageName;
                    $message = 'File uploaded successfully';
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}


if (!function_exists('singleFileUpload')) {

    function singleFileUpload($file_tag) {

        $file_ary = $_FILES[$file_tag];

        return fileUpload($file_ary);
    }

}

if (!function_exists('multiFileUpload')) {

    function multiFileUpload($file_tag) {

        //print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

        //print_r($file_ary);die;

        $output_array = array();

        foreach ($file_ary as $file) {

            array_push($output_array, fileUpload($file));
        }

        return $output_array;
    }

}
if (!function_exists('fileUpload')) {

    function fileUpload($file) {

        //If directory doesnot exists create it.

        $data = array();

        $output_dir = IMG_DIR;
        $output_subdir = $output_dir . "doc/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "pdf",
                "doc",
                "docx"
            );
            //echo $file_ext;die;       
            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a PDF Or DOC file.";
            }
            if ($file_size > 104857600) {
                $errors[] = 'File size must be less than 100 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

                if (move_uploaded_file($file_tmp, "$filepath_original")) {
                    $data["file_name"] = $NewImageName;
                    $data['original_file_name'] = $file_name;
                    $data["file_ext"] = $file_ext;
                    $message = 'File uploaded successfully';
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}

/*

 * ***********************************************************************************

 * IMAGE UPLOAD START

 * ***********************************************************************************

 */


if (!function_exists('singleImageUpload')) {

    function singleImageUpload($file_tag) {

        $file_ary = $_FILES[$file_tag];

        return imageUpload($file_ary);
    }

}

if (!function_exists('multiImageUpload')) {

    function multiImageUpload($file_tag) {

        //print_r($_FILES[$file_tag]);die;

        $file_ary = reArrayFiles($_FILES[$file_tag]);

        //print_r($file_ary);die;

        $output_array = array();

        foreach ($file_ary as $file) {

            array_push($output_array, imageUpload($file));
        }

        return $output_array;
    }

}


if (!function_exists('reArrayFiles')) {

    function reArrayFiles(&$file_post) {

        // print_r($file_post['name']);die;

        $file_ary = array();

        $file_count = count($file_post['name']);

        $file_keys = array_keys($file_post);



        for ($i = 0; $i < $file_count; $i++) {

            foreach ($file_keys as $key) {

                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        //print_r($file_ary);die;

        return $file_ary;
    }

}

if (!function_exists('imageResizeLib')) {

    function imageResizeLib($file, $filepath_original, $path_size) {
        include APPPATH . 'ThirdParty/Imageresize/Imageresize.php'; 
        if ($file) {

            $image = new \Eventviva\Imageresize($file);

            $image->save($filepath_original);

            if ($path_size && !empty($path_size)) {

                foreach ($path_size as $ps) {

                    if (isset($ps['size']) && isset($ps['path'])) {

                        $image->resizeToBestFit($ps['size'], $ps['size']);

                        $image->save($ps['path']);
                    }
                }

                return true;
            }
        }

        return false;
    }

}
if (!function_exists('imageUpload')) {

    function imageUpload($file) {

        //If directory doesnot exists create it.

        $data = array();

        $output_dir = IMG_DIR;

        $output_subdir = $output_dir . "original/";

        $output_subdir1 = $output_dir . "large/";

        $output_subdir2 = $output_dir . "medium/";

        $output_subdir3 = $output_dir . "thumb/";

        if (isset($file)) {

            // print_r($file);die;

            $errors = array();

            $file_name = $file['name'];

            $file_size = $file['size'];

            $file_tmp = $file['tmp_name'];

            $file_type = $file['type'];

            //print_r($file_name) ;die;

            $file_epld = explode('.', $file_name);

            $file_ext_temp = end($file_epld);

            $file_ext = strtolower($file_ext_temp);

            $filename = '';

            $expensions = array(
                "jpeg",
                "jpg",
                "png",
                "gif"
            );

            //echo $file_ext;die;       

            if (in_array($file_ext, $expensions) === false) {

                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 10485760) {
                $errors[] = 'File size must be less than 10 MB';
            }
            if (empty($errors) == true) {

                $RandomNum = time() . date("-Ymd-hisa");

                $ImageName = str_replace(' ', '-', strtolower($file_name));

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));

                $ImageExt = str_replace('.', '', $ImageExt);

                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = 'uploads-' . rand(111, 999) . rand(11, 99) . '-' . $RandomNum . '.' . $ImageExt;

                $filepath_original = $output_subdir . $NewImageName;

                $path_size = array(
                    array('path' => $output_subdir1 . $NewImageName, 'size' => 500),
                    array('path' => $output_subdir2 . $NewImageName, 'size' => 300),
                    array('path' => $output_subdir3 . $NewImageName, 'size' => 100)
                );
                if (imageResizeLib($file_tmp, $filepath_original, $path_size)) {
                    $data["file_name"] = $NewImageName;
                    $data['original_file_name'] = $file_name;
                    $data["file_ext"] = $file_ext;
                    $message = 'File uploaded successfully';
                    return array(true, $message, $data);
                    die;
                } else {
                    $message = "Invalid, File not correct";
                    return array(false, $message, $data);
                }
            } else {
                $message = implode(" , ", $errors);
                return array(false, $message, $data);
            }
        } else {
            $message = "Required resource is invalid";
            return array(false, $message, $data);
        }
        return array(false, "System error", $data);
    }

}

function gen_uuid($user_id,$action = 'e') {   
    $code = md5(sprintf('%04x%04x%04x%04x%04x%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)) . time() . uniqid(rand() . mt_rand(1, 10000000), true));    
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {        
        $splitStr=explode('-', $user_id);
        $user_id=$splitStr[1];        
        return openssl_decrypt(base64_decode($user_id), $encrypt_method, $key, 0, $iv);
    }     
    return $code.'-'.$output;
}
function forget_password_uuid($user_id,$user_type='',$action = 'e') {   
    $code = md5(sprintf('%04x%04x%04x%04x%04x%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)) . time() . uniqid(rand() . mt_rand(1, 10000000), true));    
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
    $user_id_enc = false;
    $user_type_enc = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $user_id_enc = base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv));
        $user_type_enc = base64_encode(openssl_encrypt($user_type, $encrypt_method, $key, 0, $iv));
        return $code.'-'.$user_id_enc.'-'.$user_type_enc;
    } else if ($action == 'd') {        
        $splitStr=explode('-', $user_id);
        $user_id_code=$splitStr[1];   
        $user_type_code=$splitStr[2];
        $res=array();
        $res['user_id']=openssl_decrypt(base64_decode($user_id_code), $encrypt_method, $key, 0, $iv);
        $res['user_type']=openssl_decrypt(base64_decode($user_type_code), $encrypt_method, $key, 0, $iv);
        return $res; 
    }
}
