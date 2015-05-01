<?php
    function export_excel_csv()
{
    include('include/mysql_connect.php');

    $sql = "SELECT * FROM data";
    $rec = mysql_query($sql) or die (mysql_error());

    $num_fields = mysql_num_fields($rec);

    for($i = 0; $i < $num_fields; $i++ )
    {
        $header .= '<Cell ss:StyleID="2"><Data ss:Type="String">'.mysql_field_name($rec, $i).'</Data></Cell>';
    }

    $header = '<Row>'.$header.'</Row>';

    while($row = mysql_fetch_row($rec))
    {
        $line = '';
        foreach($row as $value)
        {
            if((!isset($value)) || ($value == ""))
            {
                $value = '<Cell ss:StyleID="1"><Data ss:Type="String"></Data></Cell>\t';
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '<Cell ss:StyleID="1"><Data ss:Type="String">' . $value . '</Data></Cell>\t';
            }
            $line .= $value;
        }
        $data .= trim("<Row>".$line."</Row>")."\n";
    }

    $data = str_replace("\r" , "" , $data);

    if ($data == "")
    {
        $data = "\n No Record Found!\n";
    }
	
    $xls_header = '<?xml version="1.0" encoding="utf-8"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">
<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
<Author></Author>
<LastAuthor></LastAuthor>
<Company></Company>
</DocumentProperties>
<Styles>
<Style ss:ID="1">
<Alignment ss:Horizontal="Left"/>
</Style>
<Style ss:ID="2">
<Alignment ss:Horizontal="Left"/>
<Font ss:Bold="1"/>
</Style>

</Styles>
<Worksheet ss:Name="Export">
<Table>';

    $xls_footer = '</Table>
<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
<Selected/>
<FreezePanes/>
<FrozenNoSplit/>
<SplitHorizontal>1</SplitHorizontal>
<TopRowBottomPane>1</TopRowBottomPane>
</WorksheetOptions>
</Worksheet>
</Workbook>';

    header("Content-type: application/vnd.ms-excel;");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$xls_header.$header.$data.$xls_footer";
}

export_excel_csv();
