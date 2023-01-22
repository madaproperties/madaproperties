<?php
    
namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('name','ASC')->paginate(10);
        return view('admin.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::orderBy('name','ASC')->get();
        return view('admin.roles.create',compact('permission'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => strtolower($request->input('name'))]);
        $role->syncPermissions($request->input('permission'));
    
        $role = Role::get();
        $roles = array();
        foreach ($role as $value) {
            if(!in_array("'".$value->name."'",$roles)){
                $roles[] = "'".$value->name."'";
            }
        } 
        if(!in_array("'".strtolower($request->input('name'))."'",$roles)){
            $roles[] = "'".strtolower($request->input('name'))."'";
        }

        $roles = implode(",",array_filter($roles));
        \DB::statement('ALTER TABLE `users` CHANGE `rule` `rule` ENUM('.$roles.') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');        
        return redirect()->route('admin.roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::orderBy('name','ASC')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = strtolower($request->input('name'));
        $role->save();
    
        $role->syncPermissions($request->input('permission'));

        $role = Role::get();
        $roles = array();
        foreach ($role as $value) {
            if(!in_array("'".$value->name."'",$roles)){
                $roles[] = "'".$value->name."'";
            }
        } 
        if(!in_array("'".strtolower($request->input('name'))."'",$roles)){
            $roles[] = "'".strtolower($request->input('name'))."'";
        }
        $roles = implode(",",array_filter($roles));
        \DB::statement('ALTER TABLE `users` CHANGE `rule` `rule` ENUM('.$roles.') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');        
        
        return redirect()->route('admin.roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin.roles.index')
                        ->with('success','Role deleted successfully');
    }
}