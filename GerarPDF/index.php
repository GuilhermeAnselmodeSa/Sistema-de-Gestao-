<?php
require_once 'vendor/autoload.php';
include_once("../lib/Conexao.php");

use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();

$options->setIsRemoteEnabled(true);

$pdo = Conexao::connect();
$codpedido = $_GET["idpedido"];
$listagem = $pdo->query("SELECT * FROM pedido_detalhe as ped INNER JOIN produtos as prod on prod.codigo = ped.codproduto INNER JOIN pedido as p on p.idpedido = ped.idpedido INNER JOIN clientes as cli on p.idcliente = cli.idcliente where ped.idpedido = '$codpedido'");
$html = '<h1>Adega J&P </h1>';
$html .= '<hr>';
$html .= '<h2>Cupom</h2>';
$html .= '<style>';
$html .= '*{font-family: Arial, Helvetica, sans-serif; text-align: center;}';
$html .= '</style>';
$html .= '<table border=1 width=100%>;';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<td>Categoria</td>';
$html .= '<td width=90px>Marca</td>';
$html .= '<td>Qtde</td>';
$html .= '<td>Subtotal</td>';
$html .= '</tr>';
$html .= '</thead>';
while($prodplcli = $listagem->fetch(PDO::FETCH_ASSOC)){
    $html .= '<tbody>';	
    $html .='<tr><td>'. $prodplcli['fkcategoria'] . '</td>';
    $html .='<td>'. $prodplcli['marca'] . '</td>';	
    $html .='<td>'. $prodplcli['quantidade_vendida'] . '</td>';
    $html .='<td>'. $prodplcli['subtotal'] . '</td></tr>';
    $html .= '</tbody>';
    $valor = $prodplcli['valor'];
    $ncli = $prodplcli['nome'];
    $ccli = $prodplcli['cpf'];
    $dataped = $prodplcli['dataped'];
}
$html .= '</table> <br>';
$html .='<h3> Nome do Cliente: <br>'. $ncli . '</h3>';
$html .='<h3> CPF do Cliente: <br>'. $ccli . '</h3>';
$html .='<h3> Data da emissão do cupom: <br>'. $dataped . '</h3>';
$html .='<h3> Valor total: <br> R$ ' .$valor . '</h3>';




$dompdf = new Dompdf;

$dompdf->loadHtml($html);

$dompdf->setPaper('A5', 'portrait');

$dompdf->render();

$dompdf->stream('caixa.pdf', array('Attachment'=> false));

?>