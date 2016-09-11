<?php

class InvoicePDF extends TCPDF
{
  private $is_original = true;
  private $settings = array
  (
    'fill_color' => array(153,153,153),
    'text_color' => array(0,0,0),
    'draw_color' => array(102,102,102),
    'line_width' => 0.3,
      'font' => 'dejavusans',
    'footer_message'=> 'UWAGI: Informujemy, że oryginał faktury VAT dokumentujący sprzedaż naszych usług zawiera dane zgodne z obowiązującymi przepisami RP i nie wymaga podpisu.'
  );
  
  private $data = array
  (
      'invoice_name' => 'Faktura VAT nr 13/05/AL/2010',
      'place_of_issue' => 'Miejsce wystawienia',
      'sell_by_date' => 'Data sprzedaży',
      'invoice_date' => 'Data wystawienia faktury',
      'seller' => 'Sprzedawca',
      'buyer' => 'Nabywca',
      'service_name' => 'Nazwa usługi',
      'net' => 'Wartość netto',
      'gross_value' => 'Wartość brutto',
      'vat' => '23%',
      'vat_rate' => 'Podstawowy podatek 23%',
      'vat_amount' => 'Kwota VAT',
      'total_price' => '600,00zł',
      'words' => 'Słownie',
      'paid_by_bank_transfer' => 'Zapłacono przelewem',
      'exhibited' => 'Wystawił',
      'received' => 'Odebrał',
  );

  private function setDataInvoice($invoice)
  {
      $this->data['invoice_name'] = $invoice->getName();
      $this->data['place_of_issue'] = $invoice->getPlaceOfIssue();
      $this->data['sell_by_date'] = $invoice->getSellByDate();
      $this->data['invoice_date'] = $invoice->getInvoiceDate();
      $this->data['seller'] = $invoice->getSeller();
      $this->data['buyer'] = $invoice->getBuyer();
      $this->data['service_name'] = $invoice->getServiceName();
      $this->data['net'] = $invoice->getNet();
      $this->data['gross_value'] = $invoice->getGrossValue();
      $this->data['vat'] = $invoice->getVat();
      $this->data['vat_rate'] = $invoice->getVatRate();
      $this->data['vat_amount'] = $invoice->getVatAmount();
      $this->data['words'] = $invoice->getWords();
      $this->data['paid_by_bank_transfer'] = $invoice->getPaidByBankTransfer();
      $this->data['total_price'] = $invoice->getTotalPrice();
      $this->data['exhibited'] = $invoice->getExhibited();
      $this->data['received'] = $invoice->getReceived();
  }

  public function __construct(InvoiceableInterface $invoiceable_object,$is_original = true)
  {
    parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $this->is_original = $is_original;
    $invoice = $invoiceable_object;
    $this->setDataInvoice($invoice);
    //FONT
    $this->SetFont($this->settings['font'], 'BI', 12);
    
    //DOCUMENT INFORMATIONS
    $this->SetCreator('katalog-firmy.net');
    $this->SetAuthor('katalog-firmy.net');
    $this->SetTitle($this->data['invoice_name']);
    $this->SetSubject('Faktura VAT');
    $this->SetKeywords('faktura, vat');

// set default header data
    $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //set margins
    $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $this->SetHeaderMargin(PDF_MARGIN_HEADER);
    $this->SetFooterMargin(PDF_MARGIN_FOOTER);

    //set auto page breaks
    $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set image scale factor
    $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //
    $this->renderBody();
  }

  //Page header
  public function Header()
  {
    // Logo
    $image_file =  dirname(__FILE__).'/../gfx/logo.jpg';
    $this->Image($image_file, 10, 10, 50, '', 'JPG', '', 'T', false, 170, '', false, false, 0, false, false, false);
    $this->renderHeaderWidget();
  }

  // Page footer
  public function Footer()
  {
    $this->SetY(-15);
    $this->SetFont($this->settings['font'], 'I', 7);
    $this->SetFillColorArray($this->settings['fill_color']);
    $this->SetTextColorArray($this->settings['text_color']);
    $this->SetDrawColorArray($this->settings['draw_color']);
    $this->SetLineWidth($this->settings['line_width']);
    $this->Write(5, $this->settings['footer_message'],'',0,'C');
    $this->Ln();
    $this->Cell(180, 5, '', 0, false, 'L', 0);
    $this->Cell(10, 5, 'Strona ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'R', 0);
  }

  public function sendToBrowser()
  {
    $this->Output($this->data['invoice_name'].'.pdf', 'I');
  }

  private function renderHeaderWidget()
  {
    if($this->PageNo() == 1)
    {
      $this->SetFillColorArray($this->settings['fill_color']);
      $this->SetTextColorArray($this->settings['text_color']);
      $this->SetDrawColorArray($this->settings['draw_color']);
      $this->SetLineWidth($this->settings['line_width']);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], 'B', 8);
      $this->Cell(50, 5, 'Miejsce wystawienia', 1, false, 'C', 1);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], '', 8);
      $this->Cell(50, 5, $this->data['place_of_issue'], 1, false, 'C', 0);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], 'B', 8);
      $this->Cell(50, 5, 'Data sprzedaży', 1, false, 'C', 1);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], '', 8);
      $this->Cell(50, 5, $this->data['sell_by_date'], 1, false, 'C', 0);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], 'B', 8);
      $this->Cell(50, 5, 'Data wystawienia faktury', 1, false, 'C', 1);
      $this->Ln();
      $this->Cell(140, 5, '', 0, false, 'L', 0);
      $this->SetFont($this->settings['font'], '', 8);
      $this->Cell(50, 5, $this->data['invoice_date'], 1, false, 'C', 0);
      $this->Ln();
    }
  }

  private function renderSellerBuyerWidget()
  {
    $this->SetFillColorArray($this->settings['fill_color']);
    $this->SetTextColorArray($this->settings['text_color']);
    $this->SetDrawColorArray($this->settings['draw_color']);
    $this->SetLineWidth($this->settings['line_width']);
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 8);
    $this->Cell(80, 5, 'Sprzedawca', 1, false, 'C', 1);
    $this->Cell(30, 5, '', 0, false, 'L', 0);
    $this->Cell(80, 5, 'Nabywca', 1, false, 'C', 1);
    $this->Ln();
    $this->SetFont($this->settings['font'], '', 8);
    $this->MultiCell(80, 25, $this->data['seller'], 1, false, 'L', 0);
    $this->Cell(30, 25, '', 0, false, 'L', 0);
    $this->MultiCell(80, 25, $this->data['buyer'], 1, false, 'L', 0);
    $this->Ln();
  }

  private function renderInvoiceName()
  {
    $this->SetFont($this->settings['font'], 'B', 18);
    $this->Cell(0, 10, $this->data['invoice_name'], 0, false, 'C', 0);
    $this->Ln();
  }

  private function renderIsOriginal()
  {
    $this->SetFont($this->settings['font'], 'B', 18);
    $text = ($this->is_original == true) ? 'ORYGINAŁ' : 'KOPIA';
    $this->Write(5, $text,'',0,'C');
    $this->Ln();
  }

  private function renderPayForServiceWidget()
  {
    $this->SetFillColorArray($this->settings['fill_color']);
    $this->SetTextColorArray($this->settings['text_color']);
    $this->SetDrawColorArray($this->settings['draw_color']);
    $this->SetLineWidth($this->settings['line_width']);
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 8);
    $this->Cell(120, 5, 'Nazwa usługi', 1, false, 'C', 1);
    $this->Cell(30, 5, 'Wartość netto', 1, false, 'C', 1);
    $this->Cell(10, 5, 'VAT', 1, false, 'C', 1);
    $this->Cell(30, 5, 'Wartość brutto', 1, false, 'C', 1);
    $this->Ln();
    $this->SetFont($this->settings['font'], '', 8);
    $this->Cell(120, 5, $this->data['service_name'], 1, false, 'L', 0);
    $this->Cell(30, 5, $this->data['net'], 1, false, 'R', 0);
    $this->Cell(10, 5, $this->data['vat'], 1, false, 'R', 0);
    $this->Cell(30, 5, $this->data['gross_value'], 1, false, 'R', 0);
    $this->Ln();
  }

  private function renderVatRateWidget()
  {
    $this->SetFillColorArray($this->settings['fill_color']);
    $this->SetTextColorArray($this->settings['text_color']);
    $this->SetDrawColorArray($this->settings['draw_color']);
    $this->SetLineWidth($this->settings['line_width']);
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 8);
    $this->Cell(50, 5, '', 0, false, 'L', 0);
    $this->Cell(50, 5, 'Według stawki VAT', 1, false, 'C', 1);
    $this->Cell(30, 5, 'Wartość netto', 1, false, 'C', 1);
    $this->Cell(30, 5, 'Kwota VAT', 1, false, 'C', 1);
    $this->Cell(30, 5, 'Wartość brutto', 1, false, 'C', 1);
    $this->Ln();
    $this->SetFont($this->settings['font'], '', 8);
    $this->Cell(50, 5, '', 0, false, 'L', 0);
    $this->Cell(50, 5, $this->data['vat_rate'], 1, false, 'L', 0);
    $this->Cell(30, 5, $this->data['net'], 1, false, 'R', 0);
    $this->Cell(30, 5, $this->data['vat_amount'], 1, false, 'R', 0);
    $this->Cell(30, 5, $this->data['gross_value'], 1, false, 'R', 0);
    $this->Ln();
  }

  private function renderTotalPriceWidget()
  {
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 12);
    $text = 'Razem do zapłaty: '.$this->data['total_price'];
    $this->Write(5, $text,'',0,'L');
  }

  private function renderWordsWidget()
  {
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 12);
    $this->Write(5, 'Słownie: ','',0,'L');
    $this->SetFont($this->settings['font'], '', 12);
    $this->Write(5, $this->data['words'],'',0,'L');
  }

  private function renderPaidByBankTransferWidget()
  {
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 12);
    $this->Write(5, $this->data['paid_by_bank_transfer'],'',0,'L');
  }

  private function renderExhibitedReceivedWidget()
  {
    $this->Ln();
    $this->Ln();
    $this->SetFillColorArray($this->settings['fill_color']);
    $this->SetTextColorArray($this->settings['text_color']);
    $this->SetDrawColorArray($this->settings['draw_color']);
    $this->SetLineWidth($this->settings['line_width']);
    $this->Ln();
    $this->SetFont($this->settings['font'], 'B', 8);
    $this->Cell(80, 5, 'Wystawił', 1, false, 'C', 1);
    $this->Cell(30, 5, '', 0, false, 'L', 0);
    $this->Cell(80, 5, 'Odebrał', 1, false, 'C', 1);
    $this->Ln();
    $this->SetFont($this->settings['font'], '', 8);
    $this->Cell(80, 30, $this->data['exhibited'], 1, false, 'L', 0);
    $this->Cell(30, 30, '', 0, false, 'L', 0);
    $this->Cell(80, 30, $this->data['received'], 1, false, 'L', 0);
    $this->Ln();
  }

  private function fixHeaderHeightError()
  {
    $this->Ln();
    $this->Write(8, '');
    $this->Ln();
  }

  private function renderBody()
  {
    $this->AddPage();
    $this->fixHeaderHeightError();
    $this->renderSellerBuyerWidget();
    $this->renderInvoiceName();
    $this->renderIsOriginal();
    $this->renderPayForServiceWidget();
    $this->renderVatRateWidget();
    $this->renderTotalPriceWidget();
    $this->renderWordsWidget();
    $this->renderPaidByBankTransferWidget();
    $this->renderExhibitedReceivedWidget();    
  }

}
?>
