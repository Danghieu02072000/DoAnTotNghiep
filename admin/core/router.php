<?php

// Kiểm tra login 
if( !isset($_SESSION['info']) && ( get_controller() !== 'access' ) ){
    redirect('?mod=user&controller=access&action=index');
}

// Kiểm tra đăng nhập 
if(isset($_SESSION['info'])){
    if(!check_access(get_info_user('level')))
        redirect ('?');
}

//Triệu gọi đến file xử lý thông qua request
$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller().'Controller.php';
// var_dump($request_path);
if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action().'Action';

// Gọi hàm theo giá trị action 
call_function(array('construct', $action_name));


