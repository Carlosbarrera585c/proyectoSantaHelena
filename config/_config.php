<?php
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
config::setRowGrid(4);
config::setDbHost('localhost');
config::setDbDriver('pgsql'); // mysql
config::setDbName('santa_helena');
config::setDbPort(5432); // 5432
config::setDbUser('postgres');
config::setDbPassword('sena');
// Esto solo es necesario en caso de necesitar un socket para la DB
config::setDbUnixSocket(null);
if (config::getDbUnixSocket() !== null) {
  config::setDbDsn(
          config::getDbDriver()
          . ':unix_socket=' . config::getDbUnixSocket()
          . ';dbname=' . config::getDbName()
  );
} else {
  config::setDbDsn(
          config::getDbDriver()
          . ':host=' . config::getDbHost()
          . ';port=' . config::getDbPort()
          . ';dbname=' . config::getDbName()
  );
}
//Para Windows
config::setPathAbsolute('/xampp/htdocs/proyectoSantaHelena/');
//Para Linux 
//config::setPathAbsolute('/var/www/html/proyectoSantaHelena/');
//Windows
config::setUrlBase('http://localhost/proyectoSantaHelena/web/');
//Host Virtual
//config::setUrlBase('http://www.santahelena.com/web/');
config::setScope('prod'); // prod
if (session::getInstance()->hasDefaultCulture() === false) {
  config::setDefaultCulture('es');
} else {
  config::setDefaultCulture(session::getInstance()->getDefaultCulture());
}
config::setIndexFile('index.php');
config::setFormatTimestamp('Y-m-d H:i:s');
config::setHeaderJson('Content-Type: application/json; charset=utf-8');
config::setHeaderXml('Content-Type: application/xml; charset=utf-8');
config::setHeaderHtml('Content-Type: text/html; charset=utf-8');
config::setHeaderPdf('Content-type: application/pdf; charset=utf-8');
config::setHeaderJavascript('Content-Type: text/javascript; charset=utf-8');
config::setHeaderExcel2003('Content-Type: application/vnd.ms-excel; charset=utf-8');
config::setHeaderExcel2007('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
config::setCookieNameRememberMe('mvcSiteRememberMe');
config::setCookieNameSite('mvcSite');
//Virtual Host
//config::setCookiePath('/www.santahelena.com/web/' . config::getIndexFile());
//Windows
config::setCookiePath('/proyectoSantaHelena/web/' . config::getIndexFile());
////Virtual Host
//config::setCookieDomain('http://www.santahelena.com/');
//Windows
config::setCookieDomain('http://localhost/');
config::setCookieTime(3600 * 8); // una hora en segundo 3600 y por 8 serÃ­an 8 horas
config::setDefaultModule('usuario');
config::setDefaultAction('index');
config::setDefaultModuleSecurity('shfSecurity');
config::setDefaultActionSecurity('index');
config::setDefaultModulePermission('shfSecurity');
config::setDefaultActionPermission('noPermission');