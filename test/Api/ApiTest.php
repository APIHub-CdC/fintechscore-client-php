<?php

namespace FintechScore\MX\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack as handlerStack;

use \FintechScore\MX\Client\Configuration;
use \FintechScore\MX\Client\ObjectSerializer;

use \FintechScore\MX\Client\Api\FintechScoreApi as Instance;
use \FintechScore\MX\Client\Model\Persona;
use \FintechScore\MX\Client\Model\Domicilio;
use \FintechScore\MX\Client\Model\Peticion;
use \FintechScore\MX\Client\Model\CatalogoEstados;
use \FintechScore\MX\Client\Model\CatalogoPais;

use Signer\Manager\ApiException;
use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new KeyHandler(null, null, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = handlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));   
        $handler->push($events->verify_signature_header('x-signature'));
        $client = new Client(['handler' => $handler]);

        $config = new Configuration();
        $config->setHost('the_url');
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your_api_key";
        $this->usernameCDC = "your_username";
        $this->passwordCDC = "your_password";  

    }
    
    public function testGetReporte()
    {
        try {

            $body = new Peticion();
            $persona = new Persona();
            $domicilio = new Domicilio(); 
            $catalogoEstados = new CatalogoEstados(); 
            $catalogoPais = new CatalogoPais();

            $domicilio->setDireccion("AV 535 84");
            $domicilio->setCiudad( "CIUDAD DE MEXICO");
            $domicilio->setColoniaPoblacion("SAN JUAN DE ARAGON 1RA SECC");
            $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
            $domicilio->setCP("07969");
            $domicilio->setEstado($catalogoEstados::CDMX);
            $domicilio->setPais($catalogoPais::MX);
            
            $persona->setPrimerNombre("PABLO");
            $persona->setSegundoNombre("ANTONIO");
            $persona->setApellidoPaterno("PRUEBA");
            $persona->setApellidoMaterno("ALVAREZ");
            $persona->setFechaNacimiento("1985-03-16");
            $persona->setRFC("PUAP850316MI1");
            $persona->setDomicilio($domicilio);

            $body->setFolioOtorgante("20210307");
            $body->setPersona($persona);

            $result = $this->apiInstance->getReporte($this->x_api_key, $this->usernameCDC, $this->passwordCDC, $body);
            print_r($result);
        } catch (ApiException | Exception $e) {
            echo 'Exception when calling ApiTest->testGetReporte: ', $e->getMessage(), PHP_EOL;
        }        
    }

}
