<?php

namespace App\Controllers;

require './codeigniter/vendor/autoload.php';

use App\Models\CasosModel;
use CodeIgniter\Controller;
use League\Csv\Writer;


class ExportarCSV extends Controller
{

    public function index()
    {
        /*          $data = [];
        $model = new CasosModel();
        $query = $model->query("SELECT (SELECT confirmadosCaso FROM caso c, municipio m WHERE m.idMunicipio = 10 AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1) / populacaoMunicipio * 1000 as casosPorMilHabitantes FROM municipio WHERE idMunicipio=10");
        $data = $query->getResult('array');
        var_dump($data);  */

        //we fetch the info from a DB using a PDO object
        $sth = $dbh->prepare(
            "SELECT (SELECT confirmadosCaso FROM caso c, municipio m WHERE m.idMunicipio = 10 AND c.idMunicipio = m.idMunicipio AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1) / populacaoMunicipio * 1000 as casosPorMilHabitantes FROM municipio WHERE idMunicipio=10"
        );
        //because we don't want to duplicate the data for each row
        // PDO::FETCH_NUM could also have been used
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
 
        //we create the CSV into memory
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        //we insert the CSV header
        $csv->insertOne(['firstname', 'lastname', 'email']);

        // The PDOStatement Object implements the Traversable Interface
        // that's why Writer::insertAll can directly insert
        // the data into the CSV
        $csv->insertAll($sth);

        // Because you are providing the filename you don't have to
        // set the HTTP headers Writer::output can
        // directly set them for you
        // The file is downloadable
        $csv->output('users.csv');
        die;
    }

    public function storeDt()
    {
        $model = new CasosModel();
        $model->save([
            'idCaso' => $this->request->getVar('idCaso'),
            'idMunicipio' => $this->request->getVar('idMunicipio'),
            'confirmadosCaso' => $this->request->getVar('confirmados'),
            'suspeitosCaso' => $this->request->getVar('suspeitos'),
            'descartadosCaso' => $this->request->getVar('descartados'),
            'obitosCaso' => $this->request->getVar('obitos'),
            'recuperadosCaso' => $this->request->getVar('recuperados'),
            'dataCaso' => date("Y-m-d"),
            'idUsuario' => session()->get('idUsuario'),
            'dataCaso' => $this->request->getVar('data-caso'),
            'fonteCaso' => $this->request->getVar('fonte')
        ]);
    }

    public function deleteDt($id = null)
    {
        $model = new CasosModel();
        $model->delete($id);
    }

    public function lastCasosId($id = null)
    {
        $model = new CasosModel();
        $query = $model->query("Select * FROM caso c WHERE c.idMunicipio = '" . $id . "'  AND c.deleted_at = '0000-00-00' ORDER BY c.dataCaso DESC LIMIT 1");
        $data = $query->getRowArray();
        return $data['idCaso'];
    }
}
