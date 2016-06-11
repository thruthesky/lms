# payment-gateway
Payment Gateway for Paypal, Allthegate, etc.

# TODO

## 문서화
 
아래의 내용을 AGS_pay_ing.php 에 추가해야한다. 안그러면 AGS_pay_result.php 에서 에러가 발생한다. 버그가 너무 많다.
    

    <input type=hidden name=ICHE_OUTACCTNO value="<?=$agspay->GetResult("ICHE_OUTACCTNO")?>">


## 필리핀 로컬 결제 추가. 신용카드 결제, 7/11 무통장. BDO 가상계좌 등

## 홈페이지에서 바로 영수증 출력
