<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataExcel implements ExportDataInterface
{

    const XmlHeader = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
    const XmlFooter = "</Workbook>";

    public $stringData; // stringData so far, used if export string mode
    public $tempFile; // handle to temp file (for export file mode)
    public $tempFilename; // temp file name and path (for export file mode)
    public $filename;
    public $encoding = 'UTF-8'; // encoding type to specify in file.
    public $title = 'Sheet1'; // title for Worksheet
    public static $type = null;

    public function __construct($filename = "exportdata")
    {
        $this->filename = $filename;
        self::$type = "Excel";
    }

    public function getType()
    {
        return self::type;
    }

    public function generateHeader()
    {

        // workbook header
        $output = stripslashes(sprintf(self::XmlHeader, $this->encoding)) . "\n";

        // Set up styles
        $output .= "<Styles>\n";
        $output .= "<Style ss:ID=\"sDT\"><NumberFormat ss:Format=\"Short Date\"/></Style>\n";
        $output .= "</Styles>\n";

        // worksheet header
        $output .= sprintf("<Worksheet ss:Name=\"%s\">\n    <Table>\n", htmlentities($this->title));

        return $output;
    }

    public function generateFooter()
    {
        $output = '';

        // worksheet footer
        $output .= "    </Table>\n</Worksheet>\n";

        // workbook footer
        $output .= self::XmlFooter;

        return $output;
    }

    public function generateRow($row)
    {
        $output = '';
        $output .= "        <Row>\n";
        foreach ($row as $k => $v) {
            $output .= $this->generateCell($v);
        }
        $output .= "        </Row>\n";
        return $output;
    }

    private function generateCell($item)
    {
        $output = '';
        $style = '';

        // Tell Excel to treat as a number. Note that Excel only stores roughly 15 digits, so keep
        // as text if number is longer than that.
        if (preg_match("/^-?\d+(?:[.,]\d+)?$/", $item) && (strlen($item) < 15)) {
            $type = 'Number';
        }
        // Sniff for valid dates; should look something like 2010-07-14 or 7/14/2010 etc. Can
        // also have an optional time after the date.
        //
        // Note we want to be very strict in what we consider a date. There is the possibility
        // of really screwing up the data if we try to reformat a string that was not actually
        // intended to represent a date.
        elseif (preg_match("/^(\d{1,2}|\d{4})[\/\-]\d{1,2}[\/\-](\d{1,2}|\d{4})([^\d].+)?$/", $item) &&
            ($timestamp = strtotime($item)) &&
            ($timestamp > 0) &&
            ($timestamp < strtotime('+500 years'))
        ) {
            $type = 'DateTime';
            $item = strftime("%Y-%m-%dT%H:%M:%S", $timestamp);
            $style = 'sDT'; // defined in header; tells excel to format date for display
        } else {
            $type = 'String';
        }

        $item = str_replace('&#039;', '&apos;', htmlspecialchars($item, ENT_QUOTES));
        $output .= "            ";
        $output .= $style ? "<Cell ss:StyleID=\"$style\">" : "<Cell>";
        $output .= sprintf("<Data ss:Type=\"%s\">%s</Data>", $type, $item);
        $output .= "</Cell>\n";

        return $output;
    }
}
