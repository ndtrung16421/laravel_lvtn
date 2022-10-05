<?php
return [
	// Client ID của app mà bạn đã đăng ký trên PayPal Dev
    'client_id' => env('AfaGmAlNTeWQdUyvFlremfoYPUCLjM4Bj9jQzepCSEVt_bz0UNyHDdqV-Jl7nGujquojm1igKkFMdHsb'),
    // Secret của app
    'secret' => env('EEnGn2IMak0jaCDrscnXiXEetDPJ8OYlpyJIsKkJ7rjxL0I9jL8zzZqXWf2VZLi5nInlu8qd54--Ufar'),
    'settings' => [
    	// PayPal mode, sanbox hoặc live
        'mode' => env('sanbox'),
        // Thời gian của một kết nối (tính bằng giây)
        'http.ConnectionTimeOut' => 30,
        // Có ghi log khi xảy ra lỗi
        'log.logEnabled' => true,
        // Đường dẫn đền file sẽ ghi log
        'log.FileName' => storage_path() . '/logs/paypal.log',
        // Kiểu log
        'log.LogLevel' => 'FINE'
    ],
];