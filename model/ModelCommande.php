<?php
class ModelCommande
{
    private $idCommande;
    private $email;
    private $date;
    private $montantTotal;

    public static function creerCommande($montantTotal)
    {
        $numCom = "SELECT idCommande FROM commande WHERE email = :mail";
        $array = array(
            "mail" => $_SESSION['ModelUtilisateur']['mail'],
        );

        $req = Model::getPDO()->prepare($numCom);
        $req->execute($array);
        $idCommande = $req->rowCount();

        $insert = "INSERT INTO commande (idCommande, email, montantTotal) VALUES (:idCommande, :email, :montantTotal)";
        $prep = Model::getPDO()->prepare($insert);
        $array = array(
            "idCommande" => $idCommande,
            "email" => $_SESSION['ModelUtilisateur']['mail'],
            "montantTotal" => $montantTotal,
        );
        $prep->execute($array);

        return $idCommande;
    }

    public static function pdf(){
        require_once File::build_path(array("lib","fpdf","fpdf.php"));
        require_once File::build_path(array("model","ModelLignePanier.php"));
        $tab_p=ModelLignePanier::getAllProduitsPanier($_SESSION['idPanier']);

        $string="";
        $prix=0;

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','',9);
        $pdf->SetTextColor(0);
        $pdf->SetFont('Helvetica','B',11);
        $pdf->setFillColor(230,230,230);
        $pdf->Cell(0, 0,'Librairie AS-VENGERS', 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 0,'Facture', 0, 0, 'C');
        $pdf->Ln(10);
        $pdf->Ln(10);
        foreach ($tab_p as $ligne){
            $string=$ligne['nom'];
            $pdf->Cell(0, 0, utf8_decode($string));
            $string=$ligne['prix'].' euros    quantité : '.$ligne['qte'];
            $pdf->Cell(0, 0, utf8_decode($string),0,0,'R');
            $pdf->Ln(10);
            $prix=$prix+$ligne['prix']*$ligne['qte'];
        }
        $prix=$prix."";
        $pdf->Ln(10);
        $pdf->Cell(0, 0,'Prix Total : '.$prix.' euros',0,0,'R');
        $pdf->Ln(10);
        $pdf->Ln(10);
        $pdf->Ln(10);
        $pdf->Ln(10);
        $pdf->Cell(0,0,utf8_decode('Les livres ne sont ni échangeables ni remboursable'), 0, 0, 'C');
        $pdf->Output('test.pdf','I');
    }


}
?>