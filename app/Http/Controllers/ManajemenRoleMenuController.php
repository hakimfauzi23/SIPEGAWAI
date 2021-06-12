<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManajemenRoleMenuController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:manajemen-role', ['all']);
    }

    public function index(Request $request)
    {
        $hak_akses = Permission::all();
        $roles = Role::all();
        $menus = Menu::orderBy('order', 'asc')->get();
        return view('admin.roleMenu.index', [
            'hak_akses' => $hak_akses,
            'roles' => $roles,
            'menus' => $menus,
        ]);
    }

    public function createMenu()
    {
        $hak_akses = Permission::pluck('name', 'id');
        $icon = Icon::pluck('code');
        $parent = Menu::pluck('judul', 'id');
        $last_order = Menu::latest('order')->first();
        $order = $last_order->order + 1;
        return view('admin.roleMenu.createMenu', [
            'hak_akses' => $hak_akses,
            'parent' => $parent,
            'order' => $order,
            'icon' => $icon,
        ]);
    }

    public function storeMenu(Request $request)
    {

        $this->validate($request, [
            'judul' => 'required',
            'id_hak_akses' => 'required',
            'order' => 'required',
        ]);


        $input = $request->all();

        $menu = Menu::create($input);
        Alert::success('success', ' Berhasil Membuat Menu Baru !');
        return redirect('manajemen');
    }

    public function editMenu($data)
    {
        $id = Crypt::decryptString($data);
        $icon = Icon::pluck('code');
        $menu = Menu::find($id);
        $hak_akses = Permission::pluck('name', 'id');
        $parent = Menu::pluck('judul', 'id');

        return view('admin.roleMenu.editMenu', [
            'id' => $data,
            'menu' => $menu,
            'hak_akses' => $hak_akses,
            'parent' => $parent,
            'icon' => $icon,
        ]);
    }

    public function updateMenu(Request $request, $data)
    {
        $id = Crypt::decryptString($data);

        $this->validate($request, [
            'judul' => 'required',
            'order' => 'required',
        ]);

        $menu = Menu::find($id);
        $input = $request->all();
        $menu->update($input);

        Alert::success('success', ' Berhasil Mengubah Data Menu !');
        return redirect('manajemen');
    }


    public function destroyMenu($data)
    {
        $id = Crypt::decryptString($data);
        Menu::where('id', $id)->delete();
        Alert::success('success', ' Berhasil Menghapus Menu !');
        return redirect('manajemen');
    }
}
