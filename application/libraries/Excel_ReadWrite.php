<?php

// Here is the simple code using COM object in PHP
class Excel_ReadWrite{

    private $XLSHandle;
    private $WrkBksHandle;
    private $xlBook;

    function __construct() {
        $this->XLSHandle = new COM("excel.application") or die("ERROR: Unable to instantaniate COM!\r\n"); 
    }

    function __destruct(){
        //if already existing file is opened
        if($this->WrkBksHandle != null)
        {   
            $this->WrkBksHandle->Close(True);
            unset($this->WrkBksHandle);
            $this->XLSHandle->Workbooks->Close();
        }
        //if created new xls file
        if($this->xlBook != null)
        {
            $this->xlBook->Close(True);
            unset($this->xlBook);
        }
        //Quit Excel Application
        $this->XLSHandle->Quit();
        unset($this->XLSHandle);
    }

    public function OpenFile($FilePath)
    {
        $this->WrkBksHandle = $this->XLSHandle->Workbooks->Open($FilePath);
    }

    public function ReadData($RowNo, $ClmNo)
    {
       $Value = $this->XLSHandle->ActiveSheet->Cells($RowNo, $ClmNo)->Value;
       return $Value;
    }  

    public function SaveOpenedFile()
    {
        $this->WrkBksHandle->Save(); 
    }  

    /***********************************************************************************
    * Function Name:- WriteToXlsFile() will write data based on row and column numbers
    * @Param:- $CellData- cell data
    * @Param:- $RowNumber- xlsx file row number
    * @Param:- $ColumnNumber- xlsx file column numbers
   ************************************************************************************/
   function WriteToXlsFile($CellData, $RowNumber, $ColumnNumber)
   {
       try{
               $this->XLSHandle->ActiveSheet->Cells($RowNumber,$ColumnNumber)->Value = $CellData;
           }
       catch(Exception $e){
               throw new Exception("Error:- Unable to write data to xlsx sheet");
           }
   }


   /****************************************************************************************
    * Function Name:- CreateXlsFileWithClmName() will initialize xls file with column Names
    * @Param:- $XlsColumnNames- Array of columns data
    * @Param:- $XlsColumnWidth- Array of columns width
   *******************************************************************************************/
   function CreateXlsFileWithClmNameAndWidth($WorkSheetName = "Raman", $XlsColumnNames = null, $XlsColumnWidth = null)
   {
       //Hide MS Excel application window
       $this->XLSHandle->Visible = 0;
       //Create new document
       $this->xlBook = $this->XLSHandle->Workbooks->Add();

       //Create Sheet 1
       $this->xlBook->Worksheets(1)->Name = $WorkSheetName;
       $this->xlBook->Worksheets(1)->Select;

       if($XlsColumnWidth != null)
       {
           //$XlsColumnWidth = array("A1"=>15,"B1"=>20);
           foreach($XlsColumnWidth as $Clm=>$Width)
           {
               //Set Columns Width
               $this->XLSHandle->ActiveSheet->Range($Clm.":".$Clm)->ColumnWidth = $Width;
           }    
       }
       if($XlsColumnNames != null)
       {
           //$XlsColumnNames = array("FirstColumnName"=>1, "SecondColumnName"=>2);
           foreach($XlsColumnNames as $ClmName=>$ClmNumber)
           {
               // Cells(Row,Column)
               $this->XLSHandle->ActiveSheet->Cells(1,$ClmNumber)->Value = $ClmName;
               $this->XLSHandle->ActiveSheet->Cells(1,$ClmNumber)->Font->Bold = True;
               $this->XLSHandle->ActiveSheet->Cells(1,$ClmNumber)->Interior->ColorIndex = "15";
           }
       }
   }
   //56 is for xls 8
    public function SaveCreatedFile($FileName, $FileFormat = 56)
    {
        $this->xlBook->SaveAs($FileName, $FileFormat);
    }

    public function MakeFileVisible()
    {
       //Hide MS Excel application window`enter code here`
       $this->XLSHandle->Visible = 1;
    }
}//end of EXCEL class