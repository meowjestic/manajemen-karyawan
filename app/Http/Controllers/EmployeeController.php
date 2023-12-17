<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Models\Division;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('karyawan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $division = Division::all();
        return view('components.karyawan.form', ['division' => $division]);
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
            'email'=>'required|email',
            'nama_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'domisili' => 'required|string',
            'pekerjaan' => 'required|string',
            'jabatan' => 'required|string',
            'divisi' => 'required|string',
            'gaji' => 'required|numeric',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_bergabung' => 'required|date|after:tanggal_lahir',
            'url_foto' => 'required|mimes:jpeg,png,jpg',
            'tempat_tinggal' => 'required|string'
        ]);

        $file = $request->file('url_foto');
        $save_name = $request->nama_lengkap."_".time().".".$file->getClientOriginalExtension();
        $dir = 'assets/foto_karyawan';

        if($file->move($dir,$save_name)){
            $save = Employee::create([
                'uuid' => Str::uuid(),
                'email'=> $request->email,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'domisili' => $request->domisili,
                'pekerjaan' => $request->pekerjaan,
                'jabatan' => $request->jabatan,
                'divisi_id' => $request->divisi,
                'gaji' => $request->gaji,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'tanggal_bergabung' => $request->tanggal_bergabung,
                'url_foto' => $save_name,
                'tempat_tinggal' => $request->tempat_tinggal,
            ]);
            if ($save) {
                return redirect()
                    ->route('karyawan.index')
                    ->with([
                        'success' => 'New karyawan has been created successfully'
                    ]);
                
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
                
            }
        }
        else {
            return redirect()
            ->back()
            ->withInput()
            ->with([
                'error' => 'We encouter a problem while uploading the photo, please try again'
            ]);
        }

        
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        // $karyawan = Employee::where('uuid',$uuid)->firstOrFail();
        $data = Employee::leftJoin('divisions', 'employees.divisi_id', '=', 'divisions.id')
            ->select('employees.*', 'divisions.nama_divisi')
            ->where('employees.uuid', '=' , $uuid)
            ->firstOrFail();
        return view('components.karyawan.detail', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data = Employee::where('uuid',$uuid)->firstOrFail();
        $division = Division::all();
        return view('components.karyawan.form', ['data' => $data, 'division' => $division]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'nama_lengkap' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'domisili' => 'required|string',
            'pekerjaan' => 'required|string',
            'jabatan' => 'required|string',
            'divisi' => 'required|string',
            'gaji' => 'required|numeric',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_bergabung' => 'required|date|after:tanggal_lahir',
            'url_foto' => 'nullable|mimes:jpeg,png,jpg',
            'tempat_tinggal' => 'required|string'
        ]);

        $file = "";
        $karyawan = Employee::where('uuid', $uuid)->firstOrFail();
        $karyawan->update([
            
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'domisili' => $request->domisili,
            'pekerjaan' => $request->pekerjaan,
            'jabatan' => $request->jabatan,
            'divisi_id' => $request->divisi,
            'gaji' => $request->gaji,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'tempat_tinggal' => $request->tempat_tinggal,
        ]);
        if($request->file('url_foto')){
            $file = $request->file('url_foto');
            $save_name = $request->nama_lengkap."_".time().".".$file->getClientOriginalExtension();
            $dir = 'assets/foto_karyawan';
            if($file->move($dir,$save_name)){
                $karyawan->update([
                    'url_foto' => $save_name,
                ]);
            }
            else {
                return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'We encouter a problem while uploading the photo, please try again'
                ]);
            }
            
        }
       

        if ($karyawan) {
            return redirect()
                ->route('karyawan.index')
                ->with([
                    'success' => 'karyawan has been updated successfully'
                ]);
            
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
            
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $karyawan = Employee::where('uuid', $uuid);
        if($karyawan->delete()){
            $response['success']=1;
        }else{
            $response['success']=0;
        }

        return response()->json($response);
    }

    public function getAll(){
        $data = Employee::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            $html = '<a href="karyawan/'.$row->uuid.'/edit" class="btn btn-xs btn-secondary">Edit</a> ';
            $html .= '<button data-id="'.$row->uuid.'" class="btn btn-xs btn-danger" id="delete-karyawan">Delete</button>';
            $html .= '<a href="karyawan/'.$row->uuid.'" class=" ml-1 btn btn-xs btn-success">Details</a> ';
            $html .= '<a href="karyawan/'.$row->uuid.'/pdf" class=" ml-1 btn btn-xs btn-dark">PDF</a> ';
            return $html;
        })
        ->toJson();
    }

    public function export_excell(){
        return Excel::download(new EmployeeExport, date('Y-m-d H:i:s').'_karyawan.xlsx');
    }

    public function download_pdf($uuid){
        $karyawan = Employee::where('uuid', $uuid)->firstOrFail();

        $pdf = Pdf::loadview('components.pdf.karyawan', ['data'=>$karyawan]);
        return $pdf->stream();
    }
}
