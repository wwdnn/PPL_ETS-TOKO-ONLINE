<?php

namespace App\Controllers;
// use App\Models\DashboardModel as DashboardModel;

class c_Cart extends BaseController
{
    public function index()
    {
        $cart = \Config\Services::cart();
        $data = [
            'carts' => $cart->contents()
        ];
        return view('v_cart', $data);
    }

    public function addToCart()
    {
        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id' => $this->request->getPost('idkemeja'),
            'name' => $this->request->getPost('namabrg'),
            'price' => $this->request->getPost('harga'),
            'qty' => 1,
            'options' => array(
                'gambar_barang' => $this->request->getPost('namafile'),
            )
        ));

        return redirect()->to(base_url('dashboard'));
    }

    public function update()
    {
        $cart = \Config\Services::cart();
        $i = 1;
        foreach($cart->contents() as $item) {
            $cart->update(array(
                'rowid' => $item['rowid'],
                'qty' => $this->request->getPost('quantity' . $i++),
            ));
        }
        return redirect()->to(base_url('cart'));
    }

    public function delete($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->to(base_url('cart'));
    }

    public function deleteAll()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('/'));
    }
}
