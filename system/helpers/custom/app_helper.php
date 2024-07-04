

<?php


function provab_decrypt($string){

    $CI = & get_instance ();
    $output = false;
    $encrypt_method = "AES-256-CBC";   
    $enc_password =trim(PROVAB_ENC_KEY);// stored in config file with encryption method 
    $md5_sec_key = trim(PROVAB_MD5_SECRET);
    $decrypt_password = $CI->db->query("SELECT AES_DECRYPT($enc_password,SHA2('".$md5_sec_key."',512)) AS decrypt_data");
    $db_data = $decrypt_password->row();
    $secret_key = trim($db_data->decrypt_data); 
    $secret_iv = trim(PROVAB_SECRET_IV);
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);       
    return $output;
}

function provab_encrypt($string){
    #echo $string.'<br/>';
    $CI = & get_instance ();
    $output = false;
    $encrypt_method = "AES-256-CBC";    
    $enc_password =trim(PROVAB_ENC_KEY);// stored in config file with encryption method 
    $md5_sec_key = trim(PROVAB_MD5_SECRET);
    $decrypt_password = $CI->db->query("SELECT AES_DECRYPT($enc_password,SHA2('".$md5_sec_key."',512)) AS decrypt_data");
    $db_data = $decrypt_password->row();
     $secret_iv = trim(PROVAB_SECRET_IV);
    $secret_key = trim($db_data->decrypt_data); 
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    
    return $output;

}

function generate_options($option_list = array(), $default_value = false, $override_order = false) {
   // debug('hi');die;
    $options = '';
    if ($option_list == true) {
        $array_values = array_values($option_list);
        if ($array_values[0] == true) {
            if ($default_value) {
                foreach ($option_list as $k => $v) {
                    if (in_array($v['k'], $default_value)) {
                        $selected = ' selected="selected" ';
                    } else {
                        $selected = '';
                    }
                    $options .= '<option value="' . $v['k'] . '" ' . $selected . '>' . $v['v'] . '</option>';
                }
            } else {
                foreach ($option_list as $k => $v) {
                    $options .= '<option value="' . $v['k'] . '">' . $v['v'] . '</option>';
                }
            }
        } else {

            if ($default_value) {

                foreach ($option_list as $k => $v) {
                    if (in_array($k, $default_value)) {
                      
                        $selected = ' selected="selected" ';
                    } else {
                        $selected = '';
                    }
                    $options .= '<option value="' . $k . '" ' . $selected . '>' . $v . '</option>';
                }
            } else {
                foreach ($option_list as $k => $v) {
                    $options .= '<option value="' . $k . '">' . $v . '</option>';
                }
            }
        }
    } else {
        $options .= '<option value="INVALIDIP">---</option>';
    }
    return $options;
}



?>
