<?php

namespace App\Controllers\Ajax;

use App\Models\CasosModel;
use App\Models\VacinometroModel;
use CodeIgniter\Controller;


class Graficos extends Controller
{
    #http://localhost:8080/ajax/casos/getdados
    public function getDados($id = null)
    {
        $model = new CasosModel();
        $query = $model->query("SELECT c.idCaso as id, c.dataCaso as dat, c.confirmadosCaso as conf, c.suspeitosCaso as susp, c.obitosCaso as ob, c.descartadosCaso as desca, c.recuperadosCaso as recu, m.nomeMunicipio as nome FROM caso c, municipio m WHERE m.idMunicipio = c.idMunicipio AND c.idMunicipio = " . $id . "  AND c.deleted_at = '0000-00-00 00:00:00' AND auto = 0 ORDER BY dataCaso ASC");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['id'] = $caso['id'];
            $data[$i]['datax'] = $caso['dat'];
            $data[$i]['confirmados'] = $caso['conf'];
            $data[$i]['suspeitos'] = $caso['susp'];
            $data[$i]['obitos'] = $caso['ob'];
            $data[$i]['descartados'] = $caso['desca'];
            $data[$i]['recuperados'] = $caso['recu'];
            $data[$i]['municipio'] = $caso['nome'];
            $i++;
        }
        echo json_encode($data);
    }
    public function getDadosSumarizacaoUba()
    {
        $model = new CasosModel();
        $query = $model->query("SELECT c.dataCaso as dat, SUM(c.confirmadosCaso) as conf,
        SUM(c.recuperadosCaso) as recu,
        SUM(c.obitosCaso) as ob
        FROM municipio m, casos_copy c    
        WHERE m.idMunicipio = c.idMunicipio AND c.deleted_at = '0000-00-00 00:00:00'
        AND m.idMicrorregiao = 1 
        GROUP BY c.dataCaso
		");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['datax'] = $caso['dat'];
            $data[$i]['confirmados'] = $caso['conf'];
            $data[$i]['obitos'] = $caso['ob'];
            $data[$i]['recuperados'] = $caso['recu'];
            $i++;
        }
        echo json_encode($data);
    }

    public function getDadosSumarizacaoJf()
    {
        $model = new CasosModel();
        $query = $model->query("SELECT c.dataCaso as dat, SUM(c.confirmadosCaso) as conf,
        SUM(c.recuperadosCaso) as recu,
        SUM(c.obitosCaso) as ob
        FROM municipio m, casos_copy c    
        WHERE m.idMunicipio = c.idMunicipio AND c.deleted_at = '0000-00-00 00:00:00' 
        AND m.idMicrorregiao = 2 
        GROUP BY c.dataCaso
		");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['datax'] = $caso['dat'];
            $data[$i]['confirmados'] = $caso['conf'];
            $data[$i]['obitos'] = $caso['ob'];
            $data[$i]['recuperados'] = $caso['recu'];
            $i++;
        }
        echo json_encode($data);
    }

    public function getDadosVacinometro($id = null){
        $model = new VacinometroModel();
        $model -> select("*");
        $model -> join('municipio', 'municipio.idMunicipio = vacinometro.idMunicipio');
        $model -> where("vacinometro.idMunicipio", $id);
        $model -> orderBy('vacinometro.dataVacinometro', 'DESC');
        $vacinometros = $model->findAll(1);
        $i = 0;
        $data = array();
        foreach($vacinometros as $vacinometro){
            $data[$i]['qnt1Dose'] = $vacinometro['qnt1Dose'];
            $data[$i]['qnt2Dose'] = $vacinometro['qnt2Dose'];
            $data[$i]['qnt3Dose'] = $vacinometro['qnt3Dose'];
            $data[$i]['dataVacinometro'] = $vacinometro['dataVacinometro'];
            $data[$i]['fonteVacinometro'] = $vacinometro['fonteVacinometro'];
            $data[$i]['populacaoMunicipio'] = $vacinometro['populacaoMunicipio'];
            $i++;
    }
    echo json_encode($data);
}
    public function getDadosSumarizacaoUbaVacinometro(){
        $model = new VacinometroModel();
        $query = $model->query("SELECT SUM(v.qnt1Dose) as primeraDose,
        SUM(v.qnt2Dose) as segundaDose, 
        SUM(v.qnt3Dose) as terceiraDose, 
        SUM(m.populacaoMunicipio) as populacao
        FROM vacinometro v,municipio m 
        WHERE m.idMunicipio = v.idMunicipio AND m.deleted_at = '0000-00-00 00:00:00' AND m.idMicrorregiao = 1
		");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['qnt1Dose'] = $caso['primeiraDose'];
            $data[$i]['qnt2Dose'] = $caso['segundaDose'];
            $data[$i]['qnt3Dose'] = $caso['terceiraDose'];
            $data[$i]['populacaoMunicipio'] = $caso['populacao'];
            $i++;
        }
        echo json_encode($data);
    }
    public function getDadosSumarizacaoJFVacinometro(){
        $model = new VacinometroModel();
        $query = $model->query("SELECT SUM(v.qnt1Dose) as primeraDose,
        SUM(v.qnt2Dose) as segundaDose, 
        SUM(v.qnt3Dose) as terceiraDose, 
        SUM(m.populacaoMunicipio) as populacao
        FROM vacinometro v,municipio m 
        WHERE m.idMunicipio = v.idMunicipio AND m.deleted_at = '0000-00-00 00:00:00' AND m.idMicrorregiao = 2
		");
        $casos = $query->getResult('array');

        $i = 0;
        $data = array();
        foreach ($casos as $caso) {
            $data[$i]['qnt1Dose'] = $caso['primeiraDose'];
            $data[$i]['qnt2Dose'] = $caso['segundaDose'];
            $data[$i]['qnt3Dose'] = $caso['terceiraDose'];
            $data[$i]['populacaoMunicipio'] = $caso['populacao'];
            $i++;
        }
        echo json_encode($data);

    }
}

