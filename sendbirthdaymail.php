<?php
class SendBirthdayMail extends PriceAlarm_Send
{
	protected $mailAdress;
	
	public function render();
	
	public function sendeMail($sEMail, $sProductID, $sPricealarmID, $sBidPrice)
	{
		$myConfig = $this->getConfig();
        $oAlarm = oxNew( "oxpricealarm" );
        $oAlarm->load( $sPricealarmID );

        $oLang = oxRegistry::getLang();
        $iLang = (int) $oAlarm->oxpricealarm__oxlang->value;

        $iOldLangId = $oLang->getTplLanguage();
        $oLang->setTplLanguage( $iLang );

        $oEmail = oxNew( 'oxemail' );
        $blSuccess = (int) $oEmail->sendPricealarmToCustomer( $sEMail, $oAlarm );

        $oLang->setTplLanguage( $iOldLangId );

        if ( $blSuccess ) 
        {
            $oAlarm->oxpricealarm__oxsended = new oxField( date( "Y-m-d H:i:s" ) );
          	$oAlarm->save();
		
		}
	
	public function compareDays($currentDay, $birthday)
	{
		if($currentDay == $birthday && $birthday != null)
			return true;
		else 
			return false;
	}
	
}
