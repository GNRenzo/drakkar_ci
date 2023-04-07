<?php
include 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;
use Aws\S3\Transfer;

class Filesmanage {

    private $client;
    private $cloudFront;
    private $bucket;
    private $key;

    public function __construct(){
        $options = [
            'version'       => 'latest',
            'profile'       => 'default',
            'region'        => 'us-east-1',
            'version'       => '2006-03-01',
        ];
        $this->bucket = 'dms-agrovision';
        $this->client = new S3Client($options);
        $options['version'] = '2016-01-28';
        $this->cloudFront = new CloudFrontClient($options);
        $this->key = APPPATH.'../keys/private_key.pem';
    }

    public function getUrlArchivo($cdn,$nombre_fisico){

        $urlCdn = $cdn.'dms-vacaciones';

        $condition = [
            'DateLessThan' => [ 'AWS:EpochTime' => time() + 300 ],
        ];

        return $this->cloudFront->getSignedUrl([
            'private_key' => $this->key,
            'url' => $cdn.'dms-vacaciones/'.$nombre_fisico,
            'expires' => time() + 300,
            'key_pair_id' => "K4Z6L4OZRPX6X",
            'policy'      => json_encode([
                'Statement' => [
                    [
                        'Resource' => $urlCdn . '/*',
                        'Condition' => $condition,
                    ],
                ],
            ], JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function getUrlArchivoV2($cdn,$archivo){
        $urlCdn = $cdn;

        return $this->cloudFront->getSignedUrl([
            'private_key' => $this->key,
            'url' => $cdn.$archivo,
            'expires' => time() + 300,
            'key_pair_id' => "K4Z6L4OZRPX6X",
            'policy'      => json_encode([
                'Statement' => [
                    [
                        'Resource' => $urlCdn . $archivo,
                        'Condition' => [ 'DateLessThan' => [ 'AWS:EpochTime' => time() + 300 ], ],
                    ],
                ],
            ], JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function transferFile($file){
        // Where the files will be source from
        $dest = realpath(APPPATH.'../project/dms_files');

        // Where the files will be transferred to
        $source = 's3://'.$this->bucket.'/'.$file;

        // dumpvar([
        //     $dest,
        //     $this->bucket,
        //     $file
        // ]);

        // Create a transfer object.
        $manager = new Transfer($this->client, $source, $dest);

        // Perform the transfer synchronously.
        try{
            dumpvar($manager->transfer());
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function subirArchivo($source, $path, $file){
        $result = $this->client->putObject([
            'Bucket'    => $this->bucket,
            'Key'       => $path.$file,
            'SourceFile' => $source
        ]);
    }

    public function deleteArchivo($path, $file){
        $this->client->deleteObject([
            'Bucket' => $this->bucket,
            'Key'    => $path.$file,
        ]);
    }

    public function obtenerArchivo($file){
        $file = $this->client->getObject([
            'Bucket' => $this->bucket,
            'Key'    => $file,
        ]);
        return $file;
    }

	public function nuevaCarpeta($path){
		$result = $this->client->putObject([
			'Bucket'    => $this->bucket,
			'Key'       => $path,
			'Body'      => "",
			'ACL'       => 'public-read'
		]);
	}

	public function downloadFileTemp($file,$name){
		$file = $this->client->getObject([
			'Bucket'            => $this->bucket,
			// 'CopySource'        => $file,
            'Key'               => $file
		]);
		$body = $file->get('Body');
		$body->rewind();
        $content = $body->read($file['ContentLength']);
        if (!empty($content)) {
            file_put_contents(APPPATH.'../project/dms_files/'.$name, $content); 
            return true;
        }else{
            return false;
        }
        // return $content;
		// echo "Downloaded the file and it begins with: {$body->read(26)}.\n";
	}

}
