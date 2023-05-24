<?php

namespace App\Imports;

use App\Models\NoRegistrados;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class NoRegistradosImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row 
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'documento' => ['unique:no_registrados,documento', 'unique:users,documento']
        ]; 
    }

    public function model(array $row)
    {   
        return new NoRegistrados([
            'nombre' => $row['nombre'],
            'documento' => $row['documento'],
            'email' => $row['email'],
            'perfil' => $row['perfil'],
            'hoja_vida' => $row['hoja_vida'],
            'contacto_1' => strval($row['contacto_1']),
            'contacto_2' => strval($row['contacto_2']),
            'ciudad' => $row['ciudad'],
            'cargo' => $row['cargo'],
            'aspiracion' => $row['aspiracion'],
            'estado' => $row['estado'],
            'descripcion_estado' => $row['descripcion_estado'],
            'ex_bull' => $row['ex_bull'],
        ]);
    }
}
