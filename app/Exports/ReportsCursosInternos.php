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
use PhpOffice\PhpSpreadsheet\Style\Border;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class ReportsCursosInternos implements FromArray, WithHeadings, WithDefaultStyles, WithBackgroundColor, WithStyles, ShouldAutoSize

{
  protected $usuarios = [];

  public function __construct($usuarios)
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
      'Nombre de la Sucursal',
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

  public function backgroundColor()
  {
    return [
      //  'fillType'   => Fill::FILL_GRADIENT_LINEAR,
      'fillType'   => Fill::FILL_SOLID,
      //  'startColor' => ['argb' => Color::COLOR_RED],
      'startColor' => ['argb' => '#FFFFFF'],
    ];
  }

  public function styles(Worksheet $sheet)
  {

    $this->applyConditionalFormatting($sheet);
    $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setSize(12);
    $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000FF');


    // Aplicar estilo de bordes a las celdas con datos
    $sheet->getStyle('A1:J' . ($sheet->getHighestRow()))
      ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    return [
      // Estilo para la primera fila (encabezados)
      1 => [
        'font' => [
          'bold' => true,
          'size' => 12,
          'color' => ['rgb' => 'FFFFFF'], // Color blanco
        ],
        'fill' => [
          'fillType' => Fill::FILL_SOLID,
          'startColor' => [
            'argb' => '333c87', // Color azul
          ],
        ],
      ],
    ];
  }



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
