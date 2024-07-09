CREATE TABLE unidad_medida
(
  umeid bigint NOT NULL DEFAULT nextval('autounimedida'::regclass),
  umerepreset character varying,
  umenombre character varying,
  umefecha character varying,
  umetipunimed character varying,
  CONSTRAINT unidad_medida_pkey PRIMARY KEY (umeid)
);

CREATE TABLE area
(
  areid bigint NOT NULL DEFAULT nextval('autoarea'::regclass),
  areidcodigo character varying NOT NULL,
  arenombre character varying,
  areextension character varying,
  areunimedida bigint,
  arecoordinad character varying,
  arelatitud character varying,
  areorientlat character varying,
  arelongitud character varying,
  areorientlon character varying,
  aredescripci character varying,
  arefecha character varying,
  CONSTRAINT area_pkey PRIMARY KEY (areid),
  CONSTRAINT fkarearea FOREIGN KEY (areunimedida)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE unidad
(
  uniid bigint NOT NULL DEFAULT nextval('autounidad'::regclass),
  uniarea bigint NOT NULL,
  uninombre character varying NOT NULL,
  uniextension character varying NOT NULL,
  uniunimedida bigint NOT NULL,
  uniresponsab character varying NOT NULL,
  unilatitud character varying NOT NULL,
  uniorientlat character varying NOT NULL,
  unilongitud character varying NOT NULL,
  uniorientlon character varying NOT NULL,
  unidescripci character varying NOT NULL,
  unifecha character varying NOT NULL,
  CONSTRAINT unidad_pkey PRIMARY KEY (uniid),
  CONSTRAINT fkumeunidad FOREIGN KEY (uniunimedida)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkuniarea FOREIGN KEY (uniarea)
      REFERENCES area (areid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT unidad_uninombre_key UNIQUE (uninombre)
);

CREATE TABLE canal
(
  canid bigint NOT NULL DEFAULT nextval('autocanal'::regclass),
  canidcodigo character varying NOT NULL,
  cannombre character varying,
  canclase character varying,
  canuso character varying,
  cantipo character varying,
  canprofundid character varying,
  canunimedpro bigint,
  canancho character varying,
  canunimedanc bigint,
  canpendiente character varying,
  canunimedpen bigint,
  candistancia character varying,
  canunimedist bigint,
  canlatitudi character varying,
  canorienlati character varying,
  canlongitudi character varying,
  canorienloni character varying,
  canlatitudf character varying,
  canorienlatf character varying,
  canlongitudf character varying,
  canorienlonf character varying,
  canfecha character varying,
  CONSTRAINT canal_pkey PRIMARY KEY (canid),
  CONSTRAINT fkcanunimedpro FOREIGN KEY (canunimedpro)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimedanc FOREIGN KEY (canunimedanc)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimeddist FOREIGN KEY (canunimedist)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimedpen FOREIGN KEY (canunimedpen)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE clima
(
  cliid bigint NOT NULL DEFAULT nextval('autoclima'::regclass),
  clihora character varying,
  clifecha character varying,
  cliradisolar character varying,
  cliunimedrad bigint,
  clitempeaire character varying,
  cliunimedtem bigint,
  clihumeralat character varying,
  cliunimedhum bigint,
  cliprecipita character varying,
  cliunimedpre bigint,
  clivelovient character varying,
  cliunimedvel bigint,
  clidireccion character varying,
  CONSTRAINT clima_pkey PRIMARY KEY (cliid),
  CONSTRAINT fkcliunimedhum FOREIGN KEY (cliunimedhum)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkcliunimedrad FOREIGN KEY (cliunimedrad)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimedpre FOREIGN KEY (cliunimedpre)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimedtem FOREIGN KEY (cliunimedtem)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkunimedvel FOREIGN KEY (cliunimedvel)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE ruta
(
  rutid bigint NOT NULL DEFAULT nextval('autoruta'::regclass),
  rutidcodigo character varying NOT NULL,
  rutnombre character varying NOT NULL,
  rutestado character varying NOT NULL,
  rutdistancia character varying NOT NULL,
  rununimeddis bigint NOT NULL,
  ruttierecorr character varying NOT NULL,
  rununimedtie bigint NOT NULL,
  rutlatitudi character varying NOT NULL,
  rutorienlati character varying NOT NULL,
  rutlongitudi character varying NOT NULL,
  rutorienloni character varying NOT NULL,
  rutlatitudf character varying NOT NULL,
  rutorienlatf character varying NOT NULL,
  rutlongitudf character varying NOT NULL,
  rutorienlonf character varying NOT NULL,
  rutdescripci character varying NOT NULL,
  rutfecha character varying NOT NULL,
  CONSTRAINT ruta_pkey PRIMARY KEY (rutid),
  CONSTRAINT fkrutunimeddis FOREIGN KEY (rununimeddis)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkrutunimedtie FOREIGN KEY (rununimedtie)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE construccion
(
  conid bigint NOT NULL DEFAULT nextval('autoconstruccion'::regclass),
  conidcodigo character varying NOT NULL,
  conunidad bigint,
  connombre character varying,
  conextension character varying,
  conunimedcon bigint,
  contipambien character varying,
  contipconstr character varying,
  conestado character varying,
  contipcubiert character varying,
  contippiso character varying,
  contipmuro character varying,
  confecconstr character varying,
  confecremode character varying,
  conlatitud character varying,
  conorientlat character varying,
  conlongitud character varying,
  conorientlon character varying,
  confecha character varying,
  CONSTRAINT pkconstruccion PRIMARY KEY (conid),
  CONSTRAINT fkconstruccion FOREIGN KEY (conunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkconunimedcon FOREIGN KEY (conunimedcon)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE suelo
(
  sueid bigint NOT NULL DEFAULT nextval('autosuelo'::regclass),
  suefhumedad character varying,
  sueunimedhu bigint,
  sueftextura character varying,
  suefporocida character varying,
  sueunimedpo bigint,
  suefconsiste character varying,
  sueunimedco bigint,
  suefcolorter character varying,
  suefcondelet character varying,
  sueunimedel bigint,
  sueqnitrogen character varying,
  sueunimedni bigint,
  sueqfosforo character varying,
  sueunimedfo bigint,
  sueqpotacio character varying,
  sueunimedpt bigint,
  sueqelemmeno character varying,
  sueqeleminte character varying,
  sueqph character varying,
  sueunimedph bigint,
  suebmateorga character varying,
  sueunimedma bigint,
  suebactimicr character varying,
  sueunimedam bigint,
  suebmasmicro character varying,
  sueunimedmm bigint,
  suefecha character varying,
  CONSTRAINT suelo_pkey PRIMARY KEY (sueid),
  CONSTRAINT fk_sueunimedam FOREIGN KEY (sueunimedam)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedco FOREIGN KEY (sueunimedco)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedel FOREIGN KEY (sueunimedel)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedfo FOREIGN KEY (sueunimedfo)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedhu FOREIGN KEY (sueunimedhu)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedma FOREIGN KEY (sueunimedma)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedmm FOREIGN KEY (sueunimedmm)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedni FOREIGN KEY (sueunimedni)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedph FOREIGN KEY (sueunimedph)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedpo FOREIGN KEY (sueunimedpo)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_sueunimedpt FOREIGN KEY (sueunimedpt)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE cultivo
(
  culid bigint NOT NULL DEFAULT nextval('autocultivo'::regclass),
  culidcodigo character varying NOT NULL,
  culnomcomun character varying,
  culnomcienti character varying,
  culorigen character varying,
  cullugarorig character varying,
  culclimafavo character varying,
  culdistsiemb character varying,
  culunimedsie bigint,
  culvidautil character varying,
  cultiempvida character varying,
  culextension character varying,
  culunimedida bigint,
  cullatitud character varying,
  culorientlat character varying,
  cullongitud character varying,
  culorientlon character varying,
  culfecha character varying,
  CONSTRAINT cultivo_pkey PRIMARY KEY (culid),
  CONSTRAINT fkculunime FOREIGN KEY (culunimedsie)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkculunimedsie FOREIGN KEY (culunimedsie)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT um_fk FOREIGN KEY (culunimedida)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE enfermedad
(
  enfid bigint NOT NULL DEFAULT nextval('autoenfermedad'::regclass),
  enfnomcomun character varying,
  enfnomcinti character varying,
  enftipagecau character varying,
  enfmorvimort character varying,
  enfsintomas character varying,
  enftratamien character varying,
  enffecha character varying,
  CONSTRAINT enfermedad_pkey PRIMARY KEY (enfid)
);

CREATE TABLE especie
(
  espid bigint NOT NULL DEFAULT nextval('autoespecie'::regclass),
  espunidad bigint,
  esptipespeci character varying,
  espnomcomun character varying,
  espnomcienti character varying,
  espfecha character varying,
  CONSTRAINT especie_pkey PRIMARY KEY (espid),
  CONSTRAINT especie_espunidad_fkey FOREIGN KEY (espunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE enfermedad_especie
(
  eesid bigint NOT NULL DEFAULT nextval('autoenfesp'::regclass),
  eeskidcodigo bigint NOT NULL,
  eesenfermeda bigint NOT NULL,
  eesespecie bigint NOT NULL,
  eesdescripci character varying NOT NULL,
  eesfecha character varying NOT NULL,
  CONSTRAINT pk_eeskidcodigo PRIMARY KEY (eesenfermeda, eesespecie),
  CONSTRAINT enfermedad_especie_eesenfermeda_fkey FOREIGN KEY (eesenfermeda)
      REFERENCES enfermedad (enfid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_eseespecie FOREIGN KEY (eesespecie)
      REFERENCES especie (espid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT enfermedad_especie_eeskidcodigo_key UNIQUE (eeskidcodigo)
);

CREATE TABLE raza
(
  razid bigint NOT NULL DEFAULT nextval('autoraza'::regclass),
  raznombre character varying,
  razorigen character varying,
  razlugorigen character varying,
  razproposito character varying,
  razproducion character varying,
  razunimedpro bigint,
  razcarfenoti character varying,
  razfecha character varying,
  CONSTRAINT raza_pkey PRIMARY KEY (razid),
  CONSTRAINT fkumeraza FOREIGN KEY (razunimedpro)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE especie_raza
(
  eraid bigint NOT NULL DEFAULT nextval('autoespecieraza'::regclass),
  erakidcodigo bigint NOT NULL,
  eraespecie bigint NOT NULL,
  eraraza bigint NOT NULL,
  eradescripci character varying,
  erafecha character varying,
  CONSTRAINT especie_raza_pkey PRIMARY KEY (eraespecie, eraraza),
  CONSTRAINT especie_raza_eraespecie_fkey FOREIGN KEY (eraespecie)
      REFERENCES especie (espid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkeraespecie FOREIGN KEY (eraespecie)
      REFERENCES raza (razid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT especie_raza_erakidcodigo_key UNIQUE (erakidcodigo)
);

CREATE TABLE especieacuatica
(
  eacid bigint NOT NULL DEFAULT nextval('autoespecieacuaticas'::regclass),
  eacunidad bigint,
  eactipespeci character varying,
  eacnomcomun character varying,
  eacnomcienti character varying,
  eacfecha character varying,
  CONSTRAINT especieacuarica_pkey PRIMARY KEY (eacid),
  CONSTRAINT fk_especieacuaticauni FOREIGN KEY (eacunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE estanque
(
  estid bigint NOT NULL DEFAULT nextval('autoestanque'::regclass),
  estnombre character varying NOT NULL,
  esttipestanq character varying,
  estprofundid character varying,
  estunimedpro bigint,
  estespejagua character varying,
  estunimedesp bigint,
  estvolumagua character varying,
  estunimedvol bigint,
  estfecha character varying,
  CONSTRAINT estanque_pkey PRIMARY KEY (estid),
  CONSTRAINT fkestesp FOREIGN KEY (estunimedesp)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkestpro FOREIGN KEY (estunimedpro)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkestvol FOREIGN KEY (estunimedvol)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE estanque_especieacuatica
(
  eeaid bigint NOT NULL DEFAULT nextval('autoestanqueespacua'::regclass),
  eeapkcodigo bigint NOT NULL,
  eeaestanque bigint NOT NULL,
  eeaespacua bigint NOT NULL,
  eearesponsab character varying,
  eeafecsiembr character varying,
  eeafeccosech character varying,
  eeadescripci character varying,
  eeafecha character varying,
  CONSTRAINT pk_eeapkcodigo PRIMARY KEY (eeaestanque, eeaespacua),
  CONSTRAINT estanque_especieacuatica_eesenfermeda_fkey FOREIGN KEY (eeaestanque)
      REFERENCES estanque (estid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_eeaespacua FOREIGN KEY (eeaespacua)
      REFERENCES especieacuatica (eacid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT estanque_especieacuatica_eeapkcodigo_key UNIQUE (eeapkcodigo)
);

CREATE TABLE lagranja
(
  lagid bigint NOT NULL DEFAULT nextval('autolagranja'::regclass),
  lagnit character varying,
  lagnombre character varying,
  lagdireccio character varying,
  lagdepartam character varying,
  lagmunicipi character varying,
  lagvereda character varying,
  lagcodprenu character varying,
  lagcodprean character varying,
  lagmatriinm character varying,
  lagactiecon character varying,
  lagfecfunda character varying,
  lagareaterr character varying,
  lagunimedat bigint,
  lagareconst character varying,
  lagunimedac bigint,
  lagcanconst character varying,
  lagaltitud character varying,
  lagunimedam bigint,
  lagplancha character varying,
  lagescala character varying,
  laglatitud character varying,
  lagorientlat character varying,
  laglongitud character varying,
  lagorientlon character varying,
  lagfecha character varying,
  CONSTRAINT lagranja_pkey PRIMARY KEY (lagid),
  CONSTRAINT fklagunimedac FOREIGN KEY (lagunimedac)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fklagunimedam FOREIGN KEY (lagunimedam)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fklagunimedat FOREIGN KEY (lagunimedat)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE lote
(
  lotid bigint NOT NULL DEFAULT nextval('autolote'::regclass),
  lotidcodigo character varying NOT NULL,
  lotsuelo bigint,
  lotextension character varying,
  lotunimedlot bigint,
  lotlatitud character varying,
  lotorientlat character varying,
  lotlongitud character varying,
  lotorientlon character varying,
  lotfecha character varying,
  CONSTRAINT lote_pkey PRIMARY KEY (lotid),
  CONSTRAINT fklotsuelo FOREIGN KEY (lotsuelo)
      REFERENCES suelo (sueid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fklotuni FOREIGN KEY (lotunimedlot)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE vegetal
(
  vegid bigint NOT NULL DEFAULT nextval('autovegetal'::regclass),
  vegnomcomun character varying NOT NULL,
  vegnomcienti character varying NOT NULL,
  vegorigen character varying NOT NULL,
  veglugorigen character varying NOT NULL,
  vegclima character varying NOT NULL,
  vegtipo character varying NOT NULL,
  vegdescripci character varying NOT NULL,
  vegfecha character varying NOT NULL,
  CONSTRAINT vegetal_pkey PRIMARY KEY (vegid)
);

CREATE TABLE lote_cultivo
(
  lcuid bigint NOT NULL DEFAULT nextval('autolotecultivo'::regclass),
  lculote bigint NOT NULL,
  lcucultivo bigint NOT NULL,
  lcuunidad bigint NOT NULL,
  lcufechsiemb date NOT NULL,
  lcufechcosec date NOT NULL,
  lcuproduesti character varying NOT NULL,
  lcuunimedest bigint NOT NULL,
  lcuprodureal character varying NOT NULL,
  lcuunimedrea bigint NOT NULL,
  lcucosproest character varying NOT NULL,
  lcuunimedies bigint NOT NULL,
  lcucosprorea character varying NOT NULL,
  lcuunimedire bigint NOT NULL,
  lcuresponsab character varying NOT NULL,
  lcufecha character varying,
  lcucanal bigint,
  lcuplagenfer bigint,
  CONSTRAINT lote_cultivo_pkey PRIMARY KEY (lcuid),
  CONSTRAINT "estf_FK" FOREIGN KEY (lcuunimedies)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT "estimada1_FK" FOREIGN KEY (lcuunimedest)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_lotecu FOREIGN KEY (lculote)
      REFERENCES lote (lotid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT "real_FK" FOREIGN KEY (lcuunimedrea)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT "realf_FK" FOREIGN KEY (lcuunimedire)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT unidad_fk FOREIGN KEY (lcuunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE plaga
(
  plaid bigint NOT NULL DEFAULT nextval('autoplaga'::regclass),
  plaidcodigo character varying NOT NULL,
  planomcomun character varying,
  planomcienti character varying,
  plaorigen character varying,
  plalugarorig character varying,
  platipagecau character varying,
  platratamien character varying,
  plafecha character varying,
  CONSTRAINT plaga_pkey PRIMARY KEY (plaid)
);

CREATE TABLE plaga_especie
(
  pesid bigint NOT NULL DEFAULT nextval('autoplagaespecie'::regclass),
  peskidcodigo bigint NOT NULL,
  pesespecie bigint NOT NULL,
  pesplaga bigint NOT NULL,
  pesdescripci character varying NOT NULL,
  pesfecha character varying,
  CONSTRAINT plaga_pkey_y_especie_pkey PRIMARY KEY (pesespecie, pesplaga),
  CONSTRAINT fkpesespecie FOREIGN KEY (pesespecie)
      REFERENCES especie (espid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT plaga_especie_pesplaga_fkey FOREIGN KEY (pesplaga)
      REFERENCES plaga (plaid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT plaga_especie_peskidcodigo_key UNIQUE (peskidcodigo)
);

CREATE TABLE plagaenfermedad
(
  penid bigint NOT NULL DEFAULT nextval('autoplagaenfermedad'::regclass),
  pentipdano character varying,
  pennomcomun character varying,
  pennomcienti character varying,
  pentipagecau character varying,
  pentipmanejo character varying,
  pentipzaffru character varying,
  pentipzaftal character varying,
  pentipzafflo character varying,
  pentipzafrai character varying,
  pentipzafhoj character varying,
  pendescripci character varying,
  penfecha character varying,
  CONSTRAINT plagaenfermedad_pkey PRIMARY KEY (penid)
);

CREATE TABLE plagaenferme_cultivo
(
  pcuid bigint NOT NULL DEFAULT nextval('autoplagaenfermecultivo'::regclass),
  pcukidcodigo bigint NOT NULL,
  pcuplagaenfe bigint NOT NULL,
  pcucultivo bigint NOT NULL,
  pcudescripci character varying NOT NULL,
  pcufecha character varying,
  CONSTRAINT pk_plagaenfe_y_pk_cultivo PRIMARY KEY (pcuplagaenfe, pcucultivo),
  CONSTRAINT fkcultivo FOREIGN KEY (pcucultivo)
      REFERENCES cultivo (culid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkpcuplagaenfe FOREIGN KEY (pcuplagaenfe)
      REFERENCES plagaenfermedad (penid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT plagaenferme_cultivo_pcukidcodigo_key UNIQUE (pcukidcodigo)
);

CREATE TABLE plagaenferme_vegetal
(
  pveid bigint NOT NULL DEFAULT nextval('autoplagaenfermedadvegetal'::regclass),
  pvekidcogigo bigint NOT NULL,
  pveplagaenfe bigint NOT NULL,
  pvevegetal bigint NOT NULL,
  pvedescripci character varying NOT NULL,
  pvefecha character varying NOT NULL,
  CONSTRAINT pk_plagaenfe_y_pk_vegetal PRIMARY KEY (pveplagaenfe, pvevegetal),
  CONSTRAINT fkpveplagaenfe FOREIGN KEY (pveplagaenfe)
      REFERENCES plagaenfermedad (penid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkvegetal FOREIGN KEY (pvevegetal)
      REFERENCES vegetal (vegid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT plagaenferme_vegetal_pvekidcogigo_key UNIQUE (pvekidcogigo)
);

CREATE TABLE poste
(
  posid bigint NOT NULL DEFAULT nextval('autoposte'::regclass),
  posidcodigo character varying NOT NULL,
  posunidad bigint NOT NULL,
  postipmateri character varying NOT NULL,
  posestado character varying NOT NULL,
  posaltura character varying NOT NULL,
  posunimedi bigint NOT NULL,
  postiptensio character varying NOT NULL,
  posalumbrado character varying NOT NULL,
  posestalumbr character varying,
  postransform character varying NOT NULL,
  posesttransf character varying,
  posruta character varying NOT NULL,
  poslatitud character varying NOT NULL,
  posorientlat character varying NOT NULL,
  poslongitud character varying NOT NULL,
  posorientlon character varying NOT NULL,
  posfecha character varying NOT NULL,
  CONSTRAINT pk_posidcodigo PRIMARY KEY (posid),
  CONSTRAINT fk_posmedida FOREIGN KEY (posunimedi)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_posunidad FOREIGN KEY (posunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE programaformacion
(
  pfoid bigint NOT NULL DEFAULT nextval('autoprogramaformacion'::regclass),
  pfoarea bigint,
  pfonombre character varying,
  pfotipformac character varying,
  pfotieelecti character varying,
  pfounimedel bigint,
  pfotieproduc character varying,
  pfounimedep bigint,
  pfodescripci character varying,
  pfoimagen character varying,
  profecha character varying,
  CONSTRAINT pk_pfoid PRIMARY KEY (pfoid),
  CONSTRAINT fkpfounimedel FOREIGN KEY (pfounimedel)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkpfounimedep FOREIGN KEY (pfounimedep)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE puntoespecial
(
  pesid bigint NOT NULL DEFAULT nextval('autopuntoespecial'::regclass),
  pesunidad bigint,
  pesnombre character varying,
  pestippunto character varying,
  peslatitud character varying,
  pesorientlat character varying,
  peslongitud character varying,
  pesorientlog character varying,
  pesdescripci character varying,
  pesfecha character varying,
  CONSTRAINT puntoespecial_pkey PRIMARY KEY (pesid),
  CONSTRAINT fkpunidad FOREIGN KEY (pesunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE redelectrica
(
  eleid bigint NOT NULL DEFAULT nextval('autoredelectrica'::regclass),
  eleconstrucc bigint NOT NULL,
  elenumlampar character varying NOT NULL,
  elenumtomaco character varying NOT NULL,
  elenuminterr character varying NOT NULL,
  eletipventil character varying NOT NULL,
  elecantidad character varying NOT NULL,
  elefecha character varying NOT NULL,
  CONSTRAINT redelectrica_pkey PRIMARY KEY (eleid),
  CONSTRAINT redelectrica_eleconstrucc_fkey FOREIGN KEY (eleconstrucc)
      REFERENCES construccion (conid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT redelectrica_eleconstrucc_key UNIQUE (eleconstrucc)
);

CREATE TABLE redgas
(
  rgaid bigint NOT NULL DEFAULT nextval('autoredgas'::regclass),
  rgaconstrucc bigint,
  rgatipmateri character varying,
  rganumvalvul integer,
  rganumconexi integer,
  rganumcontad integer,
  rganumsoport integer,
  rgafecha character varying,
  CONSTRAINT redgas_pkey PRIMARY KEY (rgaid),
  CONSTRAINT redgas_rgaconstrucc_fkey FOREIGN KEY (rgaconstrucc)
      REFERENCES construccion (conid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT redgas_rgaconstrucc_key UNIQUE (rgaconstrucc)
);

CREATE TABLE redlogica
(
  rloid bigint NOT NULL DEFAULT nextval('autoredlogica'::regclass),
  rloconstrucc bigint NOT NULL,
  rlozonawifi character varying NOT NULL,
  rlocantacces character varying NOT NULL,
  rloredalambr character varying NOT NULL,
  rlocantanale character varying NOT NULL,
  rlounimedcca bigint NOT NULL,
  rlocantrj character varying NOT NULL,
  rlocantfibop character varying NOT NULL,
  rlocategoutp character varying NOT NULL,
  rlotopologia character varying NOT NULL,
  rlodistribuc character varying NOT NULL,
  rlorack character varying NOT NULL,
  rlocantswitc character varying NOT NULL,
  rlocantregle character varying NOT NULL,
  rlocantups character varying NOT NULL,
  rlofecha character varying NOT NULL,
  CONSTRAINT pkredlogica PRIMARY KEY (rloid),
  CONSTRAINT fk_rlounimedcca FOREIGN KEY (rlounimedcca)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkconstruccion FOREIGN KEY (rloconstrucc)
      REFERENCES construccion (conid) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE redsanitaria
(
  rsaid bigint NOT NULL DEFAULT nextval('autoredsanitaria'::regclass),
  rsaconstrucc bigint,
  rsannumbater bigint,
  rsanumducha bigint,
  rsanumlavama bigint,
  sannumgrifos bigint,
  sannumsifon bigint,
  sanfecha character varying,
  CONSTRAINT red_sanitaria_pkey PRIMARY KEY (rsaid),
  CONSTRAINT fk_rloconstr FOREIGN KEY (rsaconstrucc)
      REFERENCES construccion (conid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT redsanitaria_rsaconstrucc_key UNIQUE (rsaconstrucc)
);

CREATE TABLE usuario
(
  usuid bigint NOT NULL DEFAULT nextval('autousuario'::regclass),
  usunombre character varying,
  usuapellidos character varying,
  ususexo character varying,
  usuemail character varying,
  usutelefono character varying,
  usuusuario character varying,
  usupassword character varying,
  usurol character varying,
  usufecha character varying,
  CONSTRAINT usuario_pkey PRIMARY KEY (usuid),
  CONSTRAINT usuario_usuusuario_key UNIQUE (usuusuario)
);

CREATE TABLE registro_actividad
(
  racid bigint NOT NULL DEFAULT nextval('autoregistroactividad'::regclass),
  racusuario bigint NOT NULL,
  racactividad character varying,
  racfecha character varying,
  CONSTRAINT registro_actividad_pkey PRIMARY KEY (racid),
  CONSTRAINT fkusuario FOREIGN KEY (racusuario)
      REFERENCES usuario (usuid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE regact_lotcultivo
(
  raclcuid bigint NOT NULL DEFAULT nextval('autoregactlotcultivo'::regclass),
  raclcuusua bigint NOT NULL,
  raclcuacti character varying,
  raclculote bigint NOT NULL,
  raclcucult bigint NOT NULL,
  raclcuunid bigint NOT NULL,
  raclcufesi character varying,
  raclcufeco character varying,
  raclcupest character varying,
  raclcuunie bigint NOT NULL,
  raclcuprea character varying,
  raclcuunir bigint NOT NULL,
  raclcucosr character varying,
  raclcuuncr bigint NOT NULL,
  raclcucose character varying,
  raclcuunce bigint NOT NULL,
  raclcuresp character varying,
  raclcucana bigint NOT NULL,
  raclcupenf bigint NOT NULL,
  raclcufecha character varying,
  CONSTRAINT regact_lotecultivo PRIMARY KEY (raclcuid),
  CONSTRAINT fkusuario FOREIGN KEY (raclcuusua)
      REFERENCES usuario (usuid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE ruta_unidad
(
  runid bigint NOT NULL DEFAULT nextval('autorutaunidad'::regclass),
  runkidcodigo bigint NOT NULL,
  rununidad bigint NOT NULL,
  runruta bigint NOT NULL,
  rundistancia character varying,
  rununimeddis bigint,
  runtierecorr character varying NOT NULL,
  rununimedrec bigint,
  runtipruta character varying,
  runfecha character varying,
  CONSTRAINT uniidunidad_y_rutidcodigo PRIMARY KEY (rununidad, runruta),
  CONSTRAINT fk_rununimeddis FOREIGN KEY (rununimeddis)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fk_rununimedrec FOREIGN KEY (rununimedrec)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT uniidunidad_fkey FOREIGN KEY (rununidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT ruta_unidad_runkidcodigo_key UNIQUE (runkidcodigo)
);

CREATE TABLE unidad_canal
(
  cunid bigint NOT NULL DEFAULT nextval('autoarea'::regclass),
  cunkidcodigo bigint NOT NULL,
  cununidad bigint NOT NULL,
  cuncanal bigint NOT NULL,
  cundistancia character varying,
  cununimedist bigint,
  cundescripci character varying,
  cunfecha character varying,
  CONSTRAINT unidad_canal_pkey PRIMARY KEY (cununidad, cuncanal),
  CONSTRAINT fk_cununimedist FOREIGN KEY (cununimedist)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkcuncanal FOREIGN KEY (cuncanal)
      REFERENCES canal (canid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkcununidad FOREIGN KEY (cununidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT unidad_canal_cunkidcodigo_key UNIQUE (cunkidcodigo)
);

CREATE TABLE zonaverde
(
  zveid bigint NOT NULL DEFAULT nextval('autozonaverde'::regclass),
  zveidcodigo character varying NOT NULL,
  zveunidad bigint,
  zvetipriego character varying,
  zveextension character varying,
  zveunimedi bigint,
  zvelatitud character varying,
  zveorientlat character varying,
  zvelongitud character varying,
  zveorientlon character varying,
  zvefecha character varying,
  CONSTRAINT zonaverde_pkey PRIMARY KEY (zveid),
  CONSTRAINT fkunidad FOREIGN KEY (zveunidad)
      REFERENCES unidad (uniid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkznauni FOREIGN KEY (zveunimedi)
      REFERENCES unidad_medida (umeid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE zonaverde_vegetal
(
  zovid bigint NOT NULL DEFAULT nextval('autozonaverdevegetal'::regclass),
  zovkidcodigo bigint NOT NULL,
  zovzonaverde bigint NOT NULL,
  zovvegetal bigint NOT NULL,
  zovdescripci character varying,
  zovfecha character varying,
  CONSTRAINT zonaverde_vegetal_pkey PRIMARY KEY (zovzonaverde, zovvegetal),
  CONSTRAINT fkzovvegetal FOREIGN KEY (zovvegetal)
      REFERENCES vegetal (vegid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT fkzovzonaverde FOREIGN KEY (zovzonaverde)
      REFERENCES zonaverde (zveid) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE NO ACTION,
  CONSTRAINT zonaverde_vegetal_zovkidcodigo_key UNIQUE (zovkidcodigo)
);