<?php
class Csvimport 
{
    var $fields;/** columns names retrieved after parsing */
    var $separator = ';';/** separator used to explode each line */
    var $enclosure = '"';/** enclosure used to decorate each field */
    var $max_row_size = 4096;/** maximum row size to be used for decoding */

    function parse_file($p_Filepath) 
    {
        $file = fopen($p_Filepath, 'r');
        $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);

        $content = array();
        $i = 1;
        while (($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false) 
        {
            //if ($row != null){ 
                for ($j = 0; $j < count($this->fields); $j++) 
                {
                    $content[$i][$this->fields[$j]] = $row[$j];
                }
                $i++;
            //}
        }
        fclose($file);
        return $content;
    }
}