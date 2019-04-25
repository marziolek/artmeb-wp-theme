<?php

namespace AdvancedPostSearch\WP\Field;

/**
 * AdvancedPostSearch\WP\Field\Text class.
 */
class Text extends \AdvancedPostSearch\WP\Field {

	/** **************************************************************************************************** */

	/**
	 * Creates a new Text field.
	 *
	 * @access public
	 * @param string $key
	 * @param string $label
	 * @return void
	 */
	public function __construct($key, $label) {
		parent::__construct($key, $label);
	}

	/**
	 * Renders the field.
	 *
	 * @access public
	 * @return void
	 */
	public function render() {
		$settings = $this->getFieldSettings($this->key, ['LIKE', '=', 'IN']);
		?><input class="input-prepend" type="text" name="<?= $settings['compare']['name']; ?>" readonly="readonly" value="<?= $settings['compare']['value']; ?>" data-options="<?= $settings['compare']['options']; ?>" />
		<input class="input-prepended" type="text" id="<?= $settings['value']['id']; ?>" name="<?= $settings['value']['name']; ?>" value="<?= $settings['value']['value']; ?>" /><?php
	}

	/**
	 * Gets where.
	 *
	 * @access public
	 * @return string
	 */
	public function getWhere() {
		if ($filter = $this->getFilter($this->key, ['LIKE', '=', 'IN'], true)) {
			// return ' AND ('.$this->key.' '.$filter['compare'].' ('.$filter['value'].'))';
			return " AND (".$this->key." ".$filter["compare"]." ('COMO 23917','COMO 23916','COMO 23915','COMO 23914','COMO 23913','COMO 23912','COMO 23911','COMO 23910','PIXEL1361','PIXEL1362','PIXEL1363','PIXEL1364','PIXEL1365','PIXEL1366','PIXEL1367','PIXEL1368','PIXEL1369','PIXEL1370','PIXEL1371','PIXEL1372','PIXEL1373','PIXEL1374','PIXEL1375','PIXEL1376','PIXEL1377','PIXEL1378','PIXEL1379','PIXEL1380','PIXEL1381','PIXEL1382','PIXEL1383','PIXEL1384','PIXEL1385','PIXEL 1386','PIXEL 1387','WINDMILL 1286','WINDMILL 1284','WINDMILL 1283','WINDMILL 1282','WINDMILL 1281','Pixel 24230','Windmill 1285','Moon_damask 24200','Lisa 24110','Lisa 24111','Lisa 24112','Lisa 24113','Lisa 24115','Lisa 24114','Lisa 24116','Lisa 24117','Lisa 24118','Lisa 24119','Lisa 24120','Lisa 24121','Lecco 23930','Lecco 23931','Lecco 23932','Lecco 23933','Lecco 23934','Lecco 23935','Lecco 23936','Lecco 23937','Aster 23880','Aster 23881','Aster 23882','Aster 23883','Aster 23884','Aster 23885','Agnes 23870','Agnes 23871','Agnes 23872','Agnes 23873','Agnes 23874','Agnes 23875','Agnes 23876','Agnes 23877','Agnes 23878','Marakesz 21570','Marakesz 21571','Marakesz 21572','Marakesz 21573','Marakesz 21574','Foto kpl. 068','Foto kpl. 067','Foto kpl. 066','Foto kpl. 065','Foto kpl. 064','Foto kpl. 063','Foto kpl. 062','Foto kpl. 061','Foto kpl. 060','Foto kpl. 059','Foto kpl. 058','Foto kpl. 057','Foto kpl. 056','Foto kpl. 055','Foto kpl. 054','Foto kpl. 053','Foto kpl. 052','Foto kpl. 051','Foto kpl. 050','Foto kpl. 049','Foto 047','Foto 046','Foto 045','Foto 044','Foto 043','Foto 042','Foto 041','Foto 040','Foto 039','Foto 038','Foto 037','Foto 036','Foto 035','Foto 010','Druk C 703','Druk C 702','Druk C 701','Druk C 607','Druk C 606','Druk C 605','Druk C 604','Druk C 603','Druk C 602','Druk C 601','Druk C 704','Druk C 705','Druk C 706','Druk C 801','Druk C 802','Druk C 803','Druk C 805','Druk C 806','Druk C 901','Druk C 902','Druk C 903','Druk C 1001','Druk C 1002','Druk C 1003','Druk C 1004','Druk C 1101','Druk C 1102','Druk C 1103','Druk C 1104','Druk C 1201','Druk C 1202','Druk C 1203','Foto 048','Senegal 23720','Senegal 23721','Senegal 23722','Senegal 23723','Senegal 23730','Senegal 23731','Senegal 23732','Senegal 23733','Senegal 23734','Senegal 23740','Senegal 23741','Senegal 23742','Senegal 23743','Senegal 23750','Senegal 23751','Senegal 23752','Senegal 23753','Senegal 23754','Senegal 23755','Senegal 23760','Senegal 23761','Senegal 23762','Senegal 23770','Senegal 23771','Senegal 23772','Senegal 23780','Senegal 23781','Senegal 23782','Senegal 23783','Senegal 23790','Senegal 23791','Senegal 23792','Happy 23627','Happy 23610','Happy 23611','Happy 23612','Happy 23613','Happy 23614','Happy 23615','Happy 23616','Happy 23617','Happy 23618','Happy 23619','Happy 23620','Happy 23621','Happy 23622','Happy 23623','Happy 23624','Happy 23625','Happy 23626','Fantasy 23600','Fantasy 23601','Fantasy 23602','Fantasy 23603','Fantasy 23604','Fantasy 23605','Fantasy 23606','Falcon 23590','Falcon 23591','Falcon 23592','Falcon 23593','Falcon 23594','Falcon 23595','Marmurek 23211','Marmurek 23212','Marmurek 23214','Marmurek 23214','marmurek 23217','marmurek 23216','marmurek 23215','marmurek 23213','Marmurek 23210','meknes 21642','meknes 21641','meknes 21640','druk c 22709','druk c 22708','druk c 22707','druk c 22706','druk c 22705','druk c 22704','druk c 22703','druk c 22702','druk c 22701','druk c 22700','druk c 22699','druk c 22698','druk c 22697','druk c 22696','druk c 22695','druk c 22694','druk c 22693','druk c 22692','druk c 22691','druk c 22690','druk c 22689','druk c 22688','druk c 22687','druk c 22686','druk c 22685','druk c 22684','druk c 22683','druk c 22682','druk c 22681','druk c 22680','foto 22771','foto 22770','foto 22769','foto 22768','foto 22767','foto 22766','foto 22764','foto 22765','foto 22763','foto 22761','foto 22762','foto 22760','foto 22759','foto 22757','foto 22758','foto 22756','foto 22754','foto 22755','foto 22753','foto 22752','foto 22750','foto 22751','foto 22749','foto 22747','foto 22748','foto 22746','foto 22745','foto 22744','foto 22743','foto 22742','foto 22741','foto 22740','foto 22739','foto 22738','foto 22736','foto 22737','foto 22735','foto 22734','foto 22733','foto 22732','foto 22731','foto 22729','foto 22730','foto 22728','foto 22727','foto 22725','foto 22726','foto 22724','foto 22723','foto 22722','foto 22720','foto 22721','foto 22719','foto 22718','foto 22716','foto 22717','foto 22715','foto 22714','foto 22713','foto 22712','foto 22711','SIDI 22862','foto 22710','SIDI 22861','SIDI 22860','ROMANTIC PARIS 22859','ROMANTIC PARIS 22858','ROMANTIC PARIS 22857','NEW SAMARA 22855','NEW SAMARA 22856','NEW SAMARA 22854','MERENGUE 22853','MERENGUE 22852','MERENGUE 22850','MERENGUE 22851','MARAKESH 22849','MARAKESH 22848','MARAKESH 22847','CENTA 22845','CENTA 22846','CENTA 22844','BIZANT 22843','BIZANT 22842','BIZANT 22841','BIZANT 22840','usa 22678','taxi 22677','paris 22675','taxi 22676','paris 22674','paris 22673','paris 22672','moto 22671','moto 22670','moto 22669','gb 22668','gb 22667','gb 22665','gb 22666','gb 22664','comix 22663','comix 22662','comix 22661','22659','22660','22658','22657','22656','22655','22654','22653','22652','22651','22650','22649','22648','22647','22646','22645','22644','22643','22642','22641','22640','22639','22638','22637','22635','22636','22634','22633','22632','22631','22630','train 22626','train 22625','train 22624','train 22623','train 22622','story 22620','story 22621','sowa 22619','scooter 22617','sowa 22618','princes 22616','princes 22615','pony 22613','pony 22614','pony 22612','krowka 22610','krowka 22611','cosmos 22609','cars 22608','cars 22606','cars 22607','cars 22605','bunny 22603','cars 22604','bunny 22602','bunny 22600','bunny 22601','lily 21394','lily 21393','lily 21392','lily 21391','dacota 20721','dacota 20720','celesta 20593','amber 20051','Toro 22387','Toro 22385','Toro 22386','Topaz 22351','Topaz 22352','Topaz 22353','Toro 22380','Toro 22381','Toro 22382','Toro 22383','Toro 22384','Stella 22286','Topaz 22341','Topaz 22343','Topaz 22344','Topaz 22345','Topaz 22350','Stella 22285','Stella 22278','Stella 22279','Stella 22280','Stella 22281','Stella 22282','Stella 22283','Stella 22284','Stella 22270','Stella 22271','Stella 22272','Stella 22273','Stella 22274','Stella 22275','Stella 22276','Stella 22277','Patica 21942','Prost 22020','Prost 22021','Prost 22024','Prost 22025','Prost 22027','Prost 22028','Patica 21931','Patica 21932','Patica 21935','Patica 21936','Patica 21937','Patica 21939','Patica 21941','Mamba 21568','Patica 21930','Mamba 21561','Mamba 21562','Mamba 21564','Mamba 21565','Mamba 21566','Imperial 22492','Imperial 22493','Indiana 21300','Indiana 21301','Indiana 21302','Indiana 21303','Kongo_Pik 21354','Mamba 21560','Imperial 22489','Imperial 22490','Imperial 22491','Imperial 22484','Imperial 22485','Imperial 22487','Imperial 22488','Galaxy 21089','Galaxy 21090','Imperial 22480','Imperial 22481','Imperial 22482','Imperial 22483','Galaxy 21083','Galaxy 21084','Galaxy 21085','Galaxy 21086','Galaxy 21087','Galaxy 21088','Galaxy 21081','Galaxy 21082','Doti 20796','Elephant 22560','Elephant 22565','Elephant 22566','Elephant 22568','Elephant 22570','Galaxy 21080','Doti 20784','Doti 20785','Doti 20786','Doti 20792','Doti 20793','Doti 20794','Doti 20795','Dakar 20740','Dakar 20741','Dakar 20742','Dakar 20743','Doti 20780','Doti 20781','Doti 20783','Dakar 20731','Dakar 20732','Dakar 20733','Dakar 20734','Dakar 20735','Dakar 20736','Dakar 20737','Dakar 20739','Dakar 20730','Celtic 20602','Celtic 20603','Celtic 20604','Celtic 20605','Celtic 20608','Celtic 20609','Celtic 20610','Celtic 20611','Celtic 20613','Celtic 20614','candy_pik 20542','candy_pik 20543','candy_pik 20546','Bonita 20440','candy_pik 20547','Bonita 20441','Celtic 20600','Bonita 20442','Celtic 20601','Bonita 20443','Bonita 20444','Bonita 20445','Bonita 20446','Cairo 20490','Cairo 20491','Cairo 20497','Cairo 20500','Cairo 20501','Cairo 20506','Bonita 20436','Bonita 20438','Bonita 20439','Bergen 20404','Bergen 20405','Bergen 20406','Bergen 20407','Bergen 20408','Bergen 20409','Bonita 20430','Bonita 20431','Bonita 20432','Bonita 20433','Bonita 20435','Aston pik 20212','Bergen 20400','Bergen 20401','Bergen 20402','Bergen 20403','Akropol 20013','Aston pik 20200','Aston pik 20202','Aston pik 20208','Aston pik 20209','Akropol 20000','Akropol 20001','Akropol 20002','Akropol 20003','Akropol 20007','Akropol 20009','Akropol 20010','Akropol 20011','Akropol 20012','Lotus 21480','Amber 20050','Lotus 21481','Amber 20052','Lotus 21482','Amber 20053','Celesta 20590','Celesta 20591','Celesta 20592','Lily 21390'))";
		}
		return false;
	}

	/** **************************************************************************************************** */

}