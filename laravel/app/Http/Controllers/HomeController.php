<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeConTroller extends Controller
{
    // 
    public $data = [];
    public function index()
    {
        $this->data['welcome'] = 'Học Lập Trình Laravel';
        $this->data['content'] = '<h3>Chương 1: Nhập môn laravel</h3>
        <p>Kiến thức 1</p>
        <p>Kiến thức 2</p>
        <p>Kiến thức 3</p>
        ';

        $this->data['index'] = 1;
        $this->data['dataArr'] = [
            'item1',
            'item2',
            'item3',
        ];

        $this->data['number'] = 9;
        $this->data['message'] = 'Đặt hàng thành công';
        $this->data['title'] = 'Trang chủ';
        return view('client.home', $this->data);
    }

    public function products()
    {
        $this->data['title'] = 'sản phẩm';
        return view('clients.products', $this->data);
    }
}