<?php
     class PDF extends FPDF
        {
            function CreateFrame($type)
            {
                if($type==1)
                {
                    $this->Line(12, 60, 198, 60);
                    $this->Line(12, 70, 198, 70);
                    $this->Line(12, 60, 12, 270);
                    $this->Line(12, 270, 198, 270);
                    $this->Line(198, 270, 198, 60);
                }
                else if($type==2)
                {
                    $this->Line(12, 60, 198, 60);
                    $this->Line(12, 70, 198, 70);
                    $this->Line(12, 60, 12, 110);
                    $this->Line(12, 110, 198, 110);
                    $this->Line(198, 110, 198, 60);
                }
            }
            // Page header
            function Header()
            {
                // Logo
                $this->Image ('/images/faithlogo.png', 78,6,55);
                // Arial bold 15
                $this->SetFont('Arial','B',10);
                // Move to the right
                $this->SetX(65  );
                // Title
                $this->Write(35, 'First Asia Institute of Technology and Humanities');
                $this->SetX(48);
                $this->Write(45, 'Extended Tertiary Education Equivalency and Accreditation Program');
                // Line break
                $this->Ln(20);
            }

            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
            // Load data
            function LoadData($file)
            {
                // Read file lines
                $lines = file($file);
                $data = array();
                foreach($lines as $line)
                    $data[] = explode(';',trim($line));
                return $data;
            }

            // Simple table
            function BasicTable($header, $data)
            {
                // Header
                foreach($header as $col)
                    $this->Cell(40,7,$col,1);
                $this->Ln();
                // Data
                foreach($data as $row)
                {
                    foreach($row as $col)
                        $this->Cell(40,6,$col,1);
                    $this->Ln();
                }
            }

            // Better table
            function ImprovedTable($header, $data)
            {
                // Column widths
                $w = array(40, 35, 40, 45);
                // Header
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                // Data
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR');
                    $this->Cell($w[1],6,$row[1],'LR');
                    $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
                    $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
                    $this->Ln();
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
            }

            // Colored table
            function FancyTable($header, $data)
            {
                // Colors, line width and bold font
                $this->SetFillColor(255,0,0);
                $this->SetTextColor(255);
                $this->SetDrawColor(128,0,0);
                $this->SetLineWidth(.3);
                $this->SetFont('','B');
                // Header
                $w = array(40, 35, 40, 45);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Data
                $fill = false;
                foreach($data as $row)
                {
                    $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
                    $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                    $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
                    $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
                    $this->Ln();
                    $fill = !$fill;
                }
                // Closing line
                $this->Cell(array_sum($w),0,'','T');
            }
        }
?>