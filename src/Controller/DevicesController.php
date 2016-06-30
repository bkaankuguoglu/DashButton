<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Devices Controller
 *
 * @property \App\Model\Table\DevicesTable $Devices
 */
class DevicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $devices = $this->paginate($this->Devices);

        $this->set(compact('devices'));
        $this->set('_serialize', ['devices']);
    }

    /**
     * View method
     *
     * @param string|null $id Device id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => []
        ]);

        $this->set('device', $device);
        $this->set('_serialize', ['device']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $device = $this->Devices->newEntity();
        if ($this->request->is('post')) {
            $device = $this->Devices->patchEntity($device, $this->request->data);
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The device could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('device'));
        $this->set('_serialize', ['device']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $device = $this->Devices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $device = $this->Devices->patchEntity($device, $this->request->data);
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The device could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('device'));
        $this->set('_serialize', ['device']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $device = $this->Devices->get($id);
        if ($this->Devices->delete($device)) {
            $this->Flash->success(__('The device has been deleted.'));
        } else {
            $this->Flash->error(__('The device could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
/*
    public function test($id = null)
    {

        $AccountSid = "AC15fb2f1e0fb904f02b78a9e575270f5f"; // Your Account SID from www.twilio.com/console
        $AuthToken = "12bf3cf522c21c8b678d5d41811ab0bd";   // Your Auth Token from www.twilio.com/console

        $client = new \Services_Twilio($AccountSid, $AuthToken);

        $message = $client->account->messages->create(array(
            "From" => "+447481341593", // From a valid Twilio number
            "To" => "+31611515931",   // Text this number
            "Body" => "Your order has been received. Thanks for choosing us. -Portera",
            ));


        // Display a confirmation message on the screen
        echo "Sent message {$message->sid}";
        die();
    }
*/
     public function onlyTest($particle_long = null)
    {
        $published_at = $_POST['published_at'];
        $published_at = substr($published_at, 0 , -8 );

        $query = $this->Devices->find('all')
                                ->where(['particle_long' => $particle_long]);
        $row = $query->first();

        if($row){

        $AccountSid = "AC15fb2f1e0fb904f02b78a9e575270f5f"; // Your Account SID from www.twilio.com/console
        $AuthToken = "12bf3cf522c21c8b678d5d41811ab0bd";   // Your Auth Token from www.twilio.com/console

        $client = new \Services_Twilio($AccountSid, $AuthToken);

        $message = $client->account->messages->create(array(
            "From" => "+447481341593", // From a valid Twilio number
            "To" => $row->phone,   // Text this number
            "Body" => "Your order has been received at ".substr($published_at,11,15). "(UTC/GMT), ".substr($published_at,0,-6). ". Thanks for choosing us. -Portera",
            ));


        // Display a confirmation message on the screen
        echo "Sent message {$message->sid}";
        }else{
          echo "There is no particle device with the particle id";
        }

        die();
    }

    public function test()
    {
      $DEFAULT_URL = 'https://dashbutton-12ce9.firebaseio.com';
      $DEFAULT_TOKEN = 'pmY1SwqgQVzru2LkOq5bf6VxYjmvbr9FToSIJrqX';
      $DEFAULT_PATH = '/';

      $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
      $lines = [
        "FORCE: XX0022. ENCYPT://000.222.2345",
        "TRYPASS: ********* AUTH CODE: ALPHA GAMMA: 1___ PRIORITY 1",
        "RETRY: REINDEER FLOTILLA",
        "Z:> /FALKEN/GAMES/TICTACTOE/ EXECUTE -PLAYERS 0",
        "================================================",
        "Priority 1 // local / scanning...",
        "scanning ports...",
        "BACKDOOR FOUND (23.45.23.12.00000000)",
        "BACKDOOR FOUND (13.66.23.12.00110000)",
        "BACKDOOR FOUND (13.66.23.12.00110044)",
        "...",
        "...",
        "BRUTE.EXE -r -z",
        "...locating vulnerabilities...",
        "...vulnerabilities found...",
        "MCP/> DEPLOY CLU",
        "SCAN: __ 0100.0000.0554.0080",
        "SCAN: __ 0020.0000.0553.0080",
        "SCAN: __ 0001.0000.0554.0550",
        "SCAN: __ 0012.0000.0553.0030",
        "SCAN: __ 0100.0000.0554.0080",
        "SCAN: __ 0020.0000.0553.0080",
        "BACKDOOR FOUND (23.45.23.12.00000000)",
        "BACKDOOR FOUND (13.66.23.12.00110000)",
        "BACKDOOR FOUND (13.66.23.12.00110044)",
        "...",
        "...",
        "BRUTE.EXE -r -z",
        "...locating vulnerabilities...",
        "...vulnerabilities found...",
        "MCP/> DEPLOY CLU",
        "SCAN: __ 0100.0000.0554.0080",
        "SCAN: __ 0020.0000.0553.0080",
        "SCAN: __ 0001.0000.0554.0550",
        "SCAN: __ 0012.0000.0553.0030",
        "SCAN: __ 0100.0000.0554.0080",
        "SCAN: __ 0020.0000.0553.0080",
      ];

      foreach ($lines as $line) {
        $foo = $firebase->push($DEFAULT_PATH."code/",$line);
        echo "child_added";
        sleep(0.1);
        echo "<br> ";
      }

      die();
      }

    public function code(){
      parent::initialize();
      // Set the layout
      $this->viewBuilder()->layout('code');
    }






}
