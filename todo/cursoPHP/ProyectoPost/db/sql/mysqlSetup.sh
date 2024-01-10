# Cambiar Password
mysqladmin --user=root password "Welcome1"
#Probar Conexion
mysql --user=root --password=Welcome1 -e "SELECT 1+1"
#Crear BDD
mysql --user=root --password=Welcome1 < C:\xampp\htdocs\proyectoFinal\proyecto_php\ProyectoSesiones\db\sql\RedSocial.sql
#Probar Base de Datos
mysql --user=root --password=Welcome1 -p social -e "SELECT * FROM usuarios;"