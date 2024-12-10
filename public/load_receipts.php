<?php 
include("../includes/connect.php");
include("../classes/user.class.php");
include("../assets/fpdf/fpdf.php");

function load_receipts($email){
    global $conn;

    $user = new Users($conn);

    list($bool, $receipts) = $user->fetch_receipts($email);
    
    return array($bool,$receipts);

}

if(isset($_POST['show_receipt'])){
    $input_date = $_POST['billing_date'];
    $email = $_POST['email'];
    $billing_date = DateTime::createFromFormat('d-M-Y', $input_date)->format('Y-m-d');
    $user = new Users($conn);

    list($bool,$invoice) = $user->fetch_invoice($_POST['email'],$billing_date);

    if($bool == 'true'){
        $invoiceData = $invoice;
        if (!$invoiceData) {
            die("Invoice not found for the selected date.");
        }

        // Start output buffering
        ob_start();

        // Create a new PDF instance
        class PDF extends FPDF {
            function Header() {
                // Logo or header image can be added here
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Water Billing Management System', 0, 1, 'C');
                $this->Ln(5);
            }

            function Footer() {
                // Footer implementation if needed
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 8);
                $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
            }
        }

        // Create a new PDF instance
        $pdf = new PDF();
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', '', 12);

        // Title
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Ln(5);

        // Customer details
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Customer Email:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $invoiceData['email'], 0, 1);
        $pdf->Ln(5);

        // Billing details table
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 10, 'Bill ID', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Billing Date', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Net Amount', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Payment Method', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, $invoiceData['bill_id'], 1, 0, 'C');
        $pdf->Cell(50, 10, $invoiceData['billing_date'], 1, 0, 'C');
        $pdf->Cell(50, 10, 'RS ' . number_format($invoiceData['net_amount'], 2), 1, 0, 'C');
        $pdf->Cell(40, 10, 'Wallet', 1, 1, 'C');
        $pdf->Ln(5);

        // Additional details
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Usage Cost:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'RS ' . number_format($invoiceData['usage_cost'], 2), 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Due:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'RS ' . number_format($invoiceData['due'], 2), 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Payment Status:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $invoiceData['payment_status'], 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Payment Date:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $invoiceData['payment_date'], 0, 1);

        // Output PDF
        $pdf->Output();

        // Flush and clean output buffer
        ob_end_flush();
    }else{
        
    }
    


}
        
