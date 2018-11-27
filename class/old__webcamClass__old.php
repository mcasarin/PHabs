<?php
require_once 'connectionClass.php';
class webcamClass extends connectionClass{
    private $imageFolder="webcamImage/";
    
    //This function will create a new name for every image captured using the current data and time.
    private function getNameWithPath(){
        $name = $this->imageFolder.date('dmYHi').".jpg";
        return $name;
    }
    
    //function will get the image data and save it to the provided path with the name and save it to the database
    public function showImage(){
        $file = file_put_contents( $this->getNameWithPath(), file_get_contents('php://input') );
        if(!$file){
            return "ERROR: Failed to write data to ".$this->getNameWithPath().", check permissions\n";
        }
        else
        {
            $this->saveImageToDatabase($this->getNameWithPath()); // this line is for saveing image to database
            return $this->getNameWithPath();
        }
        
    }
    
    //function for changing the image to base64
    public function changeImagetoBase64($image){
        $path = $image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/'.$type.';base64,' . base64_encode($data);
        return $base64;
    }
    
    public function saveImageToDatabase($imageurl){
        $image=$imageurl;
        $image=$this->changeImagetoBase64($image); //if you want to go for base64 encode than enable this line
        if($image){
            $sql="Update visitantes set Foto1 = '".addslashes(file_get_contents($image))."' where rg = '28509900'";
            $connect = new connectionClass($con);
            $result=$connect->query($sql);
            if($result){
                return "Image saved to database";
            }
            else{
                return "Image not saved to database";
            }
        }
    }
    
    
}