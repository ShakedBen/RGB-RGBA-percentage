<?php
ini_set('memory_limit', '-1');
class imageRGB{
	private $file;
	private  $fileName;
	private  $fileTmpName;
	private  $fileSize;
	private  $fileError;
	private  $fileType;
	private $fileExt;
	private $fileActualExt;
	private $allowed;
	private $location;
	private $width;
	private $height;
	private $sumOfRedPixl;
	private $sumOfGreenPixl;
	private $sumOfBluePixl;
	private $sumOfAlphaPixl;
	private $pixelColorArray;
	private $hundredPercentRGB;
	private $redPercentRGB;
	private $greenPercentRGB;
	private $bluePercentRGB;
	private $hundredPercentRGBA;
	private $redPercentRGBA;
	private $greenPercentRGBA;
	private $bluePercentRGBA;
	private $alphaPercentRGBA;

/*Measures how much of each value of red green blue alpha there is
by going over each pixel in the image*/
	public function calc()
	{
		$this->intArray=array();
		$this->arrayArray=array();
		list($this->width, $this->height)=getimagesize($this->location);
		if($this->fileActualExt=='png')
		{
			/*imagecreatefrompng — Create a new image from file or URL*/
		$imgHand=imagecreatefrompng($this->location);
			if($imgHand==false)
			{
				echo '<script>alert("ERROR, you cannot upload files of this type ,the conversion was not performed correctly!")</script>';

			echo $this->backIndex();

			}
		}
		else if($this->fileActualExt=='jpeg')
		{
		$imgHand=imagecreatefromjpeg($this->location);
			if($imgHand==false)
			{
			echo '<script>alert("ERROR, you cannot upload files of this type ,the conversion was not performed correctly!")</script>';
			echo $this->backIndex();

			}
		}
		else{
			echo "The image was not converted correctly";
			die();
		}
		//matrix of pixels
		$this->pixelColorArray=array();

		for($i=0;$i<$this->height;$i++)
		{
			$this->pixelColorArray[$i]=array();
			for($j=0;$j<$this->width;$j++)
			{
						/*imagecolorat — Get the index of the color of a pixel*/
				$pixelColor=imagecolorat($imgHand,$j,$i);
						/*imagecolorsforindex  Get the colors for an pixel */

				$this->pixelColorArray[$i][$j]=imagecolorsforindex($imgHand,$pixelColor);
				$this->sumOfRedPixl=$this->sumOfRedPixl+$this->pixelColorArray[$i][$j]['red'];
				$this->sumOfGreenPixl=$this->sumOfGreenPixl+$this->pixelColorArray[$i][$j]['green'];
				$this->sumOfBluePixl=$this->sumOfBluePixl+$this->pixelColorArray[$i][$j]['blue'];
				$this->sumOfAlphaPixl=$this->sumOfAlphaPixl+$this->pixelColorArray[$i][$j]['alpha'];


			}

		}
	}


	/*Calculates the percentages of rga*/
	public function RGBPercent()
	{
		debug_to_console("in RGBPercent");
		$this->hundredPercentRGB=$this->sumOfRedPixl+$this->sumOfGreenPixl+$this->sumOfBluePixl;
		$this->redPercentRGB=(100*$this->sumOfRedPixl)/$this->hundredPercentRGB;
		$this->greenPercentRGB=(100*$this->sumOfGreenPixl)/$this->hundredPercentRGB;
		$this->bluePercentRGB=(100*$this->sumOfBluePixl)/$this->hundredPercentRGB;

	}
	/*Calculates the percentages of rgba*/
	public function RGBAPercent()
	{
		$this->hundredPercentRGBA=$this->sumOfRedPixl+$this->sumOfGreenPixl+$this->sumOfBluePixl+$this->sumOfAlphaPixl;
		$this->redPercentRGBA=(100*$this->sumOfRedPixl)/$this->hundredPercentRGBA;
		$this->greenPercentRGBA=(100*$this->sumOfGreenPixl)/$this->hundredPercentRGBA;
		$this->bluePercentRGBA=(100*$this->sumOfBluePixl)/$this->hundredPercentRGBA;
		$this->alphaPercentRGBA=(100*$this->sumOfAlphaPixl)/$this->hundredPercentRGBA;


	}

/*Returns the location of the folder where the image is saved */
	public function getLocation()
	{
		return $this->location;
	}

/*Returns the percentages of the colors at rgb*/

	public function getRedPercentRGB()
	{
		return $this->redPercentRGB;
	}
	public function getGreenPercentRGB()
	{
		return $this->greenPercentRGB;
	}
	public function getBluePercentRGB()
	{
		return $this->bluePercentRGB;
	}

	/*Returns the percentages of the colors at rgba*/
	public function getRedPercentRGBA()
	{
		return $this->redPercentRGBA;
	}
	public function getGreenPercentRGBA()
	{
		return $this->greenPercentRGBA;
	}
	public function getBluePercentRGBA()
	{
		return $this->bluePercentRGBA;
	}

	public function getAlphaPercentRGBA()
	{
		return $this->alphaPercentRGBA;
	}


	/*A constructor that initializes all the data from the received file */
	/*Saves the image under a new name in a folder in the project */

	public function __construct(){
		if(isset($_POST['submit'])){
			$this->file=$_FILES['file'];
			$this->fileName=$_FILES['file']['name'];
			$this->fileTmpName=$_FILES['file']['tmp_name'];
			$this->fileSize=$_FILES['file']['size'];
			$this->fileError=$_FILES['file']['error'];
			$this->fileType=$_FILES['file']['type'];
		
		
		
			$this->fileExt=explode('.',$this->fileName);
			$this->fileActualExt=strtolower(end($this->fileExt));
		
			$this->allowed=array('png','jpeg');
	
			if(in_array($this->fileActualExt,$this->allowed))
			{
				if($this->fileError===0)
				{
					if($this->fileSize<999999)
					{
					
						$this->newFileName=uniqid('',true).".".$this->fileActualExt;
						$this->fileDestination="upload/".$this->newFileName;
						move_uploaded_file($this->fileTmpName,$this->fileDestination);
						$this->location="upload/$this->newFileName";
						echo $this->calc();
						echo $this->RGBAPercent();
						echo $this->RGBPercent();
						
		
					}else{
						echo '<script>alert("Your file is too big!")</script>';
						echo $this->backIndex();
					}
				}else{
					echo '<script>alert("ther was an error uploading your file!")</script>';
					echo $this->backIndex();
				}
			}else
			{
				
				echo '<script>alert("ERROR, you cannot upload files of this type!")</script>';
				echo $this->backIndex();
				
		
			}
		
		}

	}
public function backIndex()
{
		/*A function that returns us to the home page after alert */
		echo '<script type="text/javascript">'; 
        echo 'window.location= "index.php"';
        echo '</script>';

	}




}


