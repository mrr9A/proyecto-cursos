<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class ReportExport implements FromArray, WithHeadings, WithDefaultStyles, WithBackgroundColor, WithStyles, ShouldAutoSize, WithMapping, WithEvents
{


  protected $usuarios;

  public function __construct(array $usuarios)
  {
    $this->usuarios = $usuarios;
  }

  public function array(): array
  {
    return $this->usuarios;
  }


  public function map($usuarios): array
  {
    $estado = "en progreso";
    if ($usuarios->estado == 1 && $usuarios->valor == 100) {
      $estado = "aprobado";
    }
    if ($usuarios->estado === 0) {
      $estado = "reprobado";
    }

    $progreso = $usuarios->valor === null ? 0 : $usuarios->valor;
    return [
      $usuarios->id_usuario,
      $usuarios->id_sgp,
      $usuarios->id_sumtotal,
      $usuarios->sucursal,
      $usuarios->empleado,
      $usuarios->puesto,
      $usuarios->trabajo,
      $usuarios->curso,
      $progreso,
      $estado,
    ];
  }

  public function headings(): array
  {
    return [
      '#',
      'ID SGP',
      'ID SUMTOTAL',
      'SUCURSAL',
      'EMPLEADO',
      'PUESTO',
      'TRABAJO',
      'CURSO',
      'PROGRESO',
      'ESTADO',
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
            'argb' => '0000FF', // Color azul
          ],
        ],
      ],
    ];
  }

  // // PARA VERIFICAR EL FORMATO CONDICIONAL
  public function registerEvents(): array
  {
      return [
          AfterSheet::class => function(AfterSheet $event) {
              $sheet = $event->sheet->getDelegate();
  
              // Estilo condicional para filas con el estado "aprobado"
              $conditional = new Conditional();
              $conditional->setConditionType(Conditional::CONDITION_EXPRESSION)
                  ->setOperatorType(Conditional::OPERATOR_EQUAL)
                  ->addCondition('=$J1="aprobado"') // Verifica el valor de la columna J (estado)
                  ->getStyle()
                  ->getFill()
                  ->setFillType(Fill::FILL_SOLID)
                  ->getStartColor()
                  ->setRGB('00FF00'); // Color de fondo verde
  
              $sheet->getStyle('A1:J' . $sheet->getHighestRow())->setConditionalStyles([$conditional]);
          }
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