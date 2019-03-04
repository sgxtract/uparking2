<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Wallet;
use App\Facade\PayPal;
use App\User;
use Carbon\Carbon;
// PayPal
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    public function continueCheckOut(Request $request, $id){
        $amount = $request['options'];

        $request->validate([
            'options' => 'required',
        ]);
        return view('shop.checkout')->with(['amount' => $amount, 'id' => $id]);
    }
    
    public function checkoutOrder($load_amount, $id){

        $wallet = Wallet::where('user_id', $id)->first();

        $apiContext = PayPal::apiContext();

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Load Wallet')
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setSku('wallet_' . $wallet->id) // Similar to `item_number` in Classic API
            ->setPrice($load_amount);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setTax(0)
            ->setSubtotal($load_amount);

        $amount = new Amount();
        $amount->setCurrency("PHP")
            ->setTotal($load_amount)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('pay.executeOrder', $load_amount))
            ->setCancelUrl(route('userBalance'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            print("Created Payment Using PayPal. Please visit the URL to Approve." . $request);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);

    }

    public function executeOrder($load_amount){

        $apiContext = PayPal::apiContext();

            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $details->setSubtotal($load_amount);

            $amount->setCurrency('PHP');
            $amount->setTotal($load_amount);
            $amount->setDetails($details);
            $transaction->setAmount($amount);

            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);

            try {

                $result = $payment->execute($execution, $apiContext);

                $newLoad = $result->transactions[0]->amount->total;

                if($result->state == 'approved'){
                    $wallet = Wallet::where('user_id', Auth::user()->id)->first();
                    $wallet->balance += $newLoad;
                    $wallet->updated_at = Carbon::now();
                    $wallet->save();
                }
            
                return redirect(route('userBalance'))->with('result', $result);
        
                try {
                    $payment = Payment::get($paymentId, $apiContext);
                } catch (Exception $ex) {
                    print('Get Payment 1');
                    exit(1);
                }
            } catch (Exception $ex) {
                print('Executed Payment 2');
                exit(1);
            }

            print('Get Payment 2');
        
            return $payment;
    }

    // Staff Add Funds To User
    public function checkOutUserFunds(Request $request, $id){
        $wallet = Wallet::where('user_id', $id)->first();
        $load_amount = $request['options'];

        $request->validate([
            'options' => 'required',
        ]);

        $apiContext = PayPal::apiContext();

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName('Load Wallet')
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setSku('wallet_' . $wallet->id) // Similar to `item_number` in Classic API
            ->setPrice($load_amount);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setSubtotal($load_amount);

        $amount = new Amount();
        $amount->setCurrency("PHP")
            ->setTotal($load_amount)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('pay.executeUserFunds', [$id, $load_amount]))
            ->setCancelUrl(route('staffAddFunds'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            print("Created Payment Using PayPal. Please visit the URL to Approve." . $request);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);
    }

    // Check Out For Staff Add Funds To User
    public function executeUserFunds($id, $load_amount){

        $user = User::where('id', $id)->first();
        
        $apiContext = PayPal::apiContext();

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setSubtotal($load_amount);

        $amount->setCurrency('PHP');
        $amount->setTotal($load_amount);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        // Add the above transaction object inside our Execution object.
        $execution->addTransaction($transaction);

        try {

            $result = $payment->execute($execution, $apiContext);

            $newLoad = $result->transactions[0]->amount->total;

            if($result->state == 'approved'){
                $wallet = Wallet::where('user_id', $id)->first();
                $wallet->balance += $newLoad;
                $wallet->updated_at = Carbon::now();
                $wallet->save();
            }
            
            return redirect(route('staffAddFunds'))->with(['result' => $result, 'success' => "Successfully added ₱ $load_amount.00 funds to $user->name $user->last_name"]);
        
            try {
                $payment = Payment::get($paymentId, $apiContext);
            } catch (Exception $ex) {
                print('Get Payment 1');
                exit(1);
            }
        } catch (Exception $ex) {
            print('Executed Payment 2');
            exit(1);
        }

        print('Get Payment 2');
        
        return $payment;

    }
    

}
