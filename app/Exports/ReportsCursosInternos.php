<?php


namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class ReportsCursosInternos implements FromArray, WithHeadings, WithDefaultStyles, WithBackgroundColor, WithStyles, ShouldAutoSize

{
    protected $usuarios = [];

  public function __construct( $usuarios)
  {
    $this->usuarios = $usuarios;
  }

  public function array(): array
  {
    return $this->usuarios;
  }

    public function headings(): array
    {
        // Aquí debes definir los encabezados de las columnas del archivo de Excel.

        // Ejemplo:
        return [
            'Codigo del Curso',
            'Nombre del Curso',
            'Primer Nombre del Usuario',
            'Segundo Nombre del Usuario',
            'Apellido Paterno del Usuario',
            'Apellido Materno del Usuario',
            'Estatús del curso',
            'Calificacion',
            'Progreso',
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        // Configure the default styles
        return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);

        // Or return the styles array
        return [
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_RED],
            ],
        ];
    }

    // color de hoja
    public function backgroundColor()
    {
      // Return RGB color code.
      // return '000000';
  
      // Return a Color instance. The fill type will automatically be set to "solid"
      // return new Color(Color::COLOR_BLUE);
  
      // Or return the styles array
      return [
        //  'fillType'   => Fill::FILL_GRADIENT_LINEAR,
        'fillType'   => Fill::FILL_SOLID,
        //  'startColor' => ['argb' => Color::COLOR_RED],
        'startColor' => ['argb' => '#FFFFFF'],
      ];
    }

    // cada celda estilo
  public function styles(Worksheet $sheet)
  {

    $this->applyConditionalFormatting($sheet);
    return [
      // Style the first row as bold text.
      1    => [
        'font' => ['bold' => true, 'size' => 12],
        'fill' => [
          'type' => Fill::FILL_SOLID,
          'color' => ['rgb' => 'FFFF00'], // Color rojo
        ],
      ],

      // Styling a specific cell by coordinate.
      // 'B2' => ['font' => ['italic' => true]],

      // // Styling an entire column.
      // 'C'  => ['font' => ['size' => 16]],
    ];
  }

//   para formato para una celda
private function applyConditionalFormatting(Worksheet $sheet)
{
  $sheet->setAutoFilter('A1:A' . $sheet->getHighestRow());

  $columnCells = $sheet->getColumnIterator('A');

  foreach ($columnCells as $cell) {
    // $cellValue = $cell->getCalculatedValue(); // Obtiene el valor de la celda

    // Aplica tu condición y formato condicional aquí
    // if ($cellValue > 10) {
    //   $cell->getStyle()->getFill()->setFillType(Fill::FILL_SOLID);
    //   $cell->getStyle()->getFill()->getStartColor()->setRGB('FF0000'); // Color rojo
    // }
  }
}

}