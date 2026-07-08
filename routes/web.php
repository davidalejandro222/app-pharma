<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::get('/categorias', function () {

    $categorias = json_decode(json_encode([
        ["codigo"=>"A02","categoria"=>"Medicamentos para el tratamiento de Trastornos causados por Ácidos"],
        ["codigo"=>"A03","categoria"=>"Medicamentos contra Trastornos Funcionales Gastrointestinales"],
        ["codigo"=>"A04","categoria"=>"Medicamentos Antieméticos y Antinauseosos"],
        ["codigo"=>"A06","categoria"=>"Medicamentos para el Estreñimiento"],
        ["codigo"=>"A07","categoria"=>"Medicamentos Antidiarreicos, Antiinflamatorios y Antiinfecciosos Intestinales"],
        ["codigo"=>"A10","categoria"=>"Medicamentos usados en Diabetes"],
        ["codigo"=>"A11","categoria"=>"Vitaminas"],
        ["codigo"=>"A12","categoria"=>"Suplementos Minerales"]
    ]));

    $html = "
    <h2>Lista de Categorías</h2>

    <table border='1' cellpadding='8' cellspacing='0'>
        <tr>
            <th>Código</th>
            <th>Categoría</th>
        </tr>";

    foreach($categorias as $categoria){
        $html .= "
        <tr>
            <td>$categoria->codigo</td>
            <td>$categoria->categoria</td>
        </tr>";
    }

    $html .= "</table>";

    return $html;
});

Route::get('/medicamentos', function () {

    $medicamentos = json_decode(json_encode([

        ["codigo"=>"A02BA02","numero"=>1,"nombre"=>"Ranitidina","dosis"=>"50 mg","forma"=>"Líquidos parenterales","via"=>"IM/IV"],
        ["codigo"=>"A02BA03","numero"=>2,"nombre"=>"Famotidina","dosis"=>"40 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A02BC01","numero"=>3,"nombre"=>"Omeprazol","dosis"=>"20 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A02BC01","numero"=>4,"nombre"=>"Omeprazol","dosis"=>"40 mg","forma"=>"Sólidos parenterales","via"=>"IV"],
        ["codigo"=>"A03BA01","numero"=>1,"nombre"=>"Atropina (Sulfato)","dosis"=>"0.5-1 mg/mL","forma"=>"Líquidos parenterales","via"=>"SC/IM/IV"],
        ["codigo"=>"A03BA03","numero"=>2,"nombre"=>"Hiosciamina (bromuro de n-butil hioscina)","dosis"=>"10 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A03BA03","numero"=>3,"nombre"=>"Hiosciamina (bromuro de n-butil hioscina)","dosis"=>"20 mg/mL","forma"=>"Líquidos parenterales","via"=>"IM/IV"],
        ["codigo"=>"A03FA01","numero"=>4,"nombre"=>"Metoclopramida (clorhidrato)","dosis"=>"5 mg/mL","forma"=>"Líquidos parenterales","via"=>"IM/IV"],
        ["codigo"=>"A03FA01","numero"=>5,"nombre"=>"Metoclopramida (clorhidrato)","dosis"=>"10 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A04AA01","numero"=>1,"nombre"=>"Ondansetron","dosis"=>"8 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A04AA01","numero"=>2,"nombre"=>"Ondansetron","dosis"=>"2 mg/mL","forma"=>"Líquidos parenterales","via"=>"IV"],
        ["codigo"=>"A04AA02","numero"=>3,"nombre"=>"Granisetron","dosis"=>"1 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"A04AA02","numero"=>4,"nombre"=>"Granisetron","dosis"=>"1 mg/mL","forma"=>"Líquidos parenterales","via"=>"IV"],
        ["codigo"=>"R06AA11","numero"=>5,"nombre"=>"Dimenhidrinato","dosis"=>"50 mg","forma"=>"Sólidos orales","via"=>"VO"],
        ["codigo"=>"R06AA11","numero"=>6,"nombre"=>"Dimenhidrinato","dosis"=>"50 mg/mL","forma"=>"Líquidos parenterales","via"=>"IM/IV"]

    ]));

    $html = "
    <h2>Lista de Medicamentos</h2>

    <table border='1' cellpadding='8' cellspacing='0'>
        <tr>
            <th>Código</th>
            <th>N°</th>
            <th>Nombre</th>
            <th>Dosis</th>
            <th>Forma farmacéutica</th>
            <th>Vía de administración</th>
        </tr>";

    foreach($medicamentos as $med){

        $html .= "
        <tr>
            <td>$med->codigo</td>
            <td>$med->numero</td>
            <td>$med->nombre</td>
            <td>$med->dosis</td>
            <td>$med->forma</td>
            <td>$med->via</td>
        </tr>";

    }

    $html .= "</table>";

    return $html;
});

Route::get('/clientes/vip', function() {
    // Creamos la lista de clientes
    $clientes = [
        (object) ['id' => 1, 'nombre' => 'Karen Criollo', 'telefono' => '+503 70000000', 'puntos_acumulados' => 15],
        (object) ['id' => 2, 'nombre' => 'Joel Cruz', 'telefono' => '+503 76000000', 'puntos_acumulados' => 5],
        (object) ['id' => 3, 'nombre' => 'Cristofer Guevara', 'telefono' => '+503 76000000', 'puntos_acumulados' => 25]
    ];

    // Creamos la tabla con los registros de los clientes de forma dinamica
    $html = '
    <table border=1 cellspacing=0>
        <thead>
            <tr>
                <th>ID CLIENTE</th>
                <th>NOMBRE</th>
                <th>TELEFONO</th>
                <th>PUNTOS ACUMULADOS</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($clientes as $cliente) {
        $html .= "
            <tr>
                <td>$cliente->id</td>
                <td>$cliente->nombre</td>
                <td>$cliente->telefono</td>
                <td>$cliente->puntos_acumulados</td>
            </tr>
        ";
    }

    $html .= '
        </tbody>
    </table>
    ';

    // Pintamos en la ventana del navegador la tabla
    echo $html;
});

Route::get('/proveedores/internacionales', function() {
    // Instrucciones: Colección de objetos proveedores
    $proveedores = [
        (object) [
            'empresa' => 'PharmaGlobal', 
            'pais_origin' => 'Alemania', 
            'medicamento_principal' => 'Paracetamol 500mg', 
            'tiempo_entrega_dias' => 12
        ],
        (object) [
            'empresa' => 'BioLatam Labs', 
            'pais_origin' => 'India', 
            'medicamento_principal' => 'Amoxicilina 1g', 
            'tiempo_entrega_dias' => 20 // Mayor a 15, activará la advertencia
        ],
        (object) [
            'empresa' => 'Medix Inc', 
            'pais_origin' => 'Estados Unidos', 
            'medicamento_principal' => 'Ibuprofeno 400mg', 
            'tiempo_entrega_dias' => 7
        ]
    ];

    // Lógica de Renderizado: Estructura de la tabla HTML
    $html = '
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>EMPRESA</th>
                <th>PAÍS DE ORIGEN</th>
                <th>MEDICAMENTO PRINCIPAL</th>
                <th>TIEMPO DE ENTREGA</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($proveedores as $proveedor) {
        // Validación: Si el tiempo es mayor a 15, agrega la advertencia de texto
        $tiempoTexto = $proveedor->tiempo_entrega_dias . " días";
        if ($proveedor->tiempo_entrega_dias > 15) {
            $tiempoTexto .= " <strong>(Demora Crítica)</strong>";
        }

        $html .= "
            <tr>
                <td>{$proveedor->empresa}</td>
                <td>{$proveedor->pais_origin}</td>
                <td>{$proveedor->medicamento_principal}</td>
                <td>{$tiempoTexto}</td>
            </tr>
        ";
    }

    $html .= '
        </tbody>
    </table>
    ';

    // Todo el bloque debe imprimirse mediante un solo echo
    echo $html;
});

Route::get('/lotes/inventario', function() {
    // Instrucciones: Arreglo de objetos que representan los lotes de la farmacia
    $lotes = [
        (object) [
            'codigo_lote' => 'LOT-2026A', 
            'nombre_medicamento' => 'Insulina Glargina', 
            'cantidad_cajas' => 150, 
            'temperatura_requerida_celsius' => 4 // Menor o igual a 5°C, activará etiqueta
        ],
        (object) [
            'codigo_lote' => 'LOT-2026B', 
            'nombre_medicamento' => 'Vitamina C Efervescente', 
            'cantidad_cajas' => 300, 
            'temperatura_requerida_celsius' => 22
        ],
        (object) [
            'codigo_lote' => 'LOT-2026C', 
            'nombre_medicamento' => 'Vacuna Heberbiovac HB', 
            'cantidad_cajas' => 85, 
            'temperatura_requerida_celsius' => 5 // Igual a 5°C, activará etiqueta
        ]
    ];

    // Estructura inicial de la tabla HTML
    $html = '
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>CÓDIGO LOTE</th>
                <th>MEDICAMENTO</th>
                <th>CANTIDAD CAJAS</th>
                <th>TEMPERATURA REQUERIDA</th>
            </tr>
        </thead>
        <tbody>
    ';

    foreach($lotes as $lote) {
        // Lógica de Control: Evalúa la temperatura
        $nombreMedicamento = $lote->nombre_medicamento;
        if ($lote->temperatura_requerida_celsius <= 5) {
            $nombreMedicamento .= " <span style='color: blue; font-weight: bold;'>[Requiere Cadena de Frío]</span>";
        }

        $html .= "
            <tr>
                <td>{$lote->codigo_lote}</td>
                <td>{$nombreMedicamento}</td>
                <td>{$lote->cantidad_cajas}</td>
                <td>{$lote->temperatura_requerida_celsius} °C</td>
            </tr>
        ";
    }

    $html .= '
        </tbody>
    </table>
    ';

    // Imprimimos la tabla final acumulada en la variable
    echo $html;
});