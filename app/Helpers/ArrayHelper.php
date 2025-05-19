<?php

namespace App\Helpers;

class ArrayHelper
{
    public static $laboratorios = [
        'Laboratorio Informática Básica Módulo II Piso 2',
        'Laboratorio de Base de Datos-Redes-SO Módulo II Piso 2',
        'Laboratorio de Sistemas Operativos Módulo II Piso 2',
        'Laboratorio de Circuitos y Sistemas Digitales Módulo II Piso 1',
        'Laboratorio Sala de Docencia Módulo II Piso 2',
    ];

    public static $bloques = [
        ['start' => '7:50 AM', 'end' => '8:40 AM'],
        ['start' => '8:45 AM', 'end' => '9:35 AM'],
        ['start' => '9:40 AM', 'end' => '10:30 AM'],
        ['start' => '10:35 AM', 'end' => '11:25 AM'],
        ['start' => '11:30 AM', 'end' => '12:20 PM'],
        ['start' => '12:25 PM', 'end' => '1:15 PM'],
        ['start' => '1:20 PM', 'end' => '2:10 PM'],
        ['start' => '2:15 PM', 'end' => '3:05 PM'],
        ['start' => '3:10 PM', 'end' => '4:00 PM'],
        ['start' => '4:05 PM', 'end' => '4:55 PM'],
        ['start' => '5:00 PM', 'end' => '5:50 PM'],
        ['start' => '5:55 PM', 'end' => '6:45 PM'],
        ['start' => '6:50 PM', 'end' => '7:40 PM'],
        ['start' => '7:45 PM', 'end' => '8:35 PM'],
    ];

    public static $dias = [
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
    ];

    public static function bloques()
    {
        return self::$bloques;
    }




    public static function sedes()
    {
        return [
            'Atlantico',
            'Villa Asia',
        ];
    }

    public static function aulasPorSede($sede)
    {
        switch (strtolower($sede)) {
            case 'Atlántico':
            case 'Atlantico':
            case 'atlantico':
                return self::aulasAtlantico();
            case 'Villa Asia':
            case 'villasia':
            case 'villa asia':
                return self::aulasVillasia();
            default:

                return [];
        }
    }


    public static function aulasAtlantico()
    {
        $aulas = [];
        for ($i = 1; $i <= 15; $i++) {
            $aulas[] = (object) [
                'id' => (string) $i,
                'descripcion' => 'Aula ' . $i
            ];
        }

        foreach (self::$laboratorios as $index => $desc) {
            $aulas[] = (object) [
                'id' => (string) (16 + $index),
                'descripcion' => $desc
            ];
        }

        return $aulas;
    }
    public static function descripcionAulaAtlanticoPorId($id)
    {
        foreach (self::aulasAtlantico() as $aula) {
            if ((string)$aula->id === (string)$id) {
                return $aula->descripcion;
            }
        }
        return null;
    }

    public static function aulasVillasia()
    {
        $aulas = [
            (object) ['id' => '1', 'descripcion' => 'Lab. Física'],
            (object) ['id' => '2', 'descripcion' => 'Sala de Dibujo'],
            (object) ['id' => '3', 'descripcion' => 'Limpro'],
            (object) ['id' => '4', 'descripcion' => 'Laboratorio de Programación Básica'],
        ];
        return $aulas;
    }
    public static function descripcionAulaVillasiaPorId($id)
    {
        foreach (self::aulasVillasia() as $aula) {
            if ((string)$aula->id === (string)$id) {
                return $aula->descripcion;
            }
        }
        return null;
    }
}
