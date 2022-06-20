<?php

namespace FintechScore\Client;

use \FintechScore\Client\Configuration;
use \FintechScore\Client\ApiException;
use \FintechScore\Client\ObjectSerializer;
use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack as handlerStack;
use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;
use \FintechScore\Client\Model\Peticion;
use \FintechScore\Client\Model\PeticionFolio;
use \FintechScore\Client\Model\Persona;
use \FintechScore\Client\Model\Domicilio;

use \FintechScore\Client\Api\FintechScoreApi as Instance;

class FintechScoreApiTest extends \PHPUnit_Framework_TestCase
{
    
public function setUp()
    {
        $password = "KEY_PASSWORD";

        $this->keypair = 'path/keypair.p12';
        $this->cert = 'path/cdc_cert.pem';
        $this->signer = new KeyHandler($this->keypair, $this->cert, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = handlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));   
        $handler->push($events->verify_signature_header('x-signature'));
        $client = new Client(['handler' => $handler]);

        $config = new Configuration();
        $config->setHost('your-url');
        
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your-x-api-key";
        $this->username = "your-username";
        $this->password = "your-password";

    }
    
    public function testGetReporte()
    {

     try{
                $request = new Peticion();
                $persona = new Persona();
                $domicilio = new Domicilio();

                $request->setFolioOtorgante("");
                $persona->setPrimerNombre("");
                $persona->setSegundoNombre("");
                $persona->setApellidoPaterno("");
                $persona->setApellidoMaterno("");
                $persona->setFechaNacimiento("");                
                $domicilio->setDireccion("");
                $domicilio->setColoniaPoblacion("");
                $domicilio->setDelegacionMunicipio("");
                $domicilio->setCiudad("");
                $domicilio->setEstado("");
                $domicilio->setCP("");
                $domicilio->setPais("");
            
                $persona->setDomicilio($domicilio);
                $request->setPersona($persona);
                $response = $this->apiInstance->getReporte($this->x_api_key,$this->username,$this->password, $request);
                $this->assertNotNull($response );
                print_r($response);

        }
 
        catch(Exception $e){
            echo 'Exception when calling ApiTest->testGetReporte: ', $e->getMessage(), PHP_EOL;
        }

    }
 public function testGetReporteFolio()
    {


     try{
                $request = new PeticionFolio();
                $request->setFolioOtorgante("");
                $request->setFolioConsulta("");
                $response = $this->apiInstance->getReporteFolio($this->x_api_key,$this->username,$this->password, $request);
                $this->assertNotNull($response );
                print_r($response);

        }
     
            catch(Exception $e){
                echo 'Exception when calling ApiTest->testGetReporteFolio: ', $e->getMessage(), PHP_EOL;
            }
    }
    
}




