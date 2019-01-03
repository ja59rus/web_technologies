<?php
function confirm_query($result_set) {
    if (!$result_set) {
        die("Сбой запроса базы данных");
    }
}

//Проверяет наличие расширенных прав у пользователя
function exist_user_group($user_id) {
    global $connection;
    $user_group_id=1;//Группа с расширенными правами
    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT u.user_id
                 FROM users u,
                      user_link_groups ulg
                WHERE u.user_id=ulg.user_id 
                  and ulg.user_group_id={$user_group_id}
                  and u.user_id = {$safe_user_id}";
    $user_query = mysqli_query($connection, $query);
    confirm_query($user_query);
    if($user = mysqli_fetch_assoc($user_query)) {
        return 1;
    } else {
        return 0;
    }
}