1. Ej 1 : factorial
Escribe una función para calcular el factorial de un número que recibirá como argumento. 
Prueba a hacerlo usando recursividad.


2. Ej 2: calculador
Este ejercicio lo haremos por partes:

a.   Escribe una función que nos devuelva el resultado de sumar los dos argumentos que se le pasen como parámetros. Construye igualmente otra para restar, multiplicar y dividir.

b.   Escribe la función calculador. Dicha función recibirá tres parámetros: dos números y el nombre de la operación que desea que se les aplique ( Observa que deben de coincidir con las funciones que hemos diseñado en el apartado anterior). Según el nombre de la función que se pase como argumento se devolverá la suma, la resta, la división o la multiplicación de los valores pasados en los otros dos argumentos.

El script deberá recoger los valores en la URL. Recuerda comprobar que los valores que recibes son numéricos y que la operación es: +,-,*,/.  Si las operaciones se reciben de esta forma habrá problemas para reconocer los valores recibidos por GET. Se recomienda el uso de urlencode()


3. Ej 3: Cadenas
Escribe una función que reciba un argumento.

Dicha función comprobará:
Si el argumento recibido es una cadena de caracteres:
en dicho caso, verificará si está vacía y si es así devolverá:   "Este es el relleno porque estaba vacía"
Si tiene contenido, devolverá la cadena recibida en mayúscula.
Si el argumento no es un string devolverá el argumento recibido más el mensaje “no es una cadena de caracteres”.


4. Ej 4: Potencias
Escribe una función para calcular potencias. La función recibirá como argumentos la base y el exponente. El exponente es opcional y tiene por defecto el valor 2


5. Ej 5: fecha
Función que nos devuelve la fecha de hoy en castellano
No olvides establecer la zona horaria:

    date_default_timezone_set('Europe/Madrid');


6. Ej 6: MCD
Escribe una función que calcule el máximo común divisor de dos números y un programa para probarla.


7. Ej 7: primo
Escribe una función para comprobar si un número es primo y un programa para probarla


8. Ej 8: matricula
Escribe una función que reciba una cadena y comprueba si es una matrícula de coche válida.

Recuerda que una matrícula tiene siete caracteres, los cuatro primeros números y el resto consonantes mayúsculas.


9. Ej 9: password
Escribe una función que reciba una cadena y comprueba si es una contraseña válida. Hay que comprobar que tenga: 

– Entre 6 y 15 caracteres.
 – Al menos un número. 
– Al menos una letra mayúscula. 
– Al menos una letra minúscula. 
– Al menos un carácter no alfanumérico


10. Ej 10: include
En el ejercicio 5 se creó una función que nos devolvía la fecha en castellano. Guarda esa función en un archivo y crea una nueva página PHP que incluya este fichero y utilice la función para mostrar en pantalla la fecha obtenida. 

Uso de include.


11. Ej 11: factorial negativo
Modifica el ejercicio cálculo de un factorial para que controle si el argumento es negativo utilizando una excepción.

Usa: InvalidArgumentException


12. Ej 12: Duplica
Escribe una función que nos permita duplicar los caracteres de la cadena que recibe como argumento.


13. Ej 13: predefinidas
A partir de la cadena de caracteres "Hola, mundo. ¿Qué tal estás hoy?" escribe un script PHP que utilice funciones predefinidas para mostrar los siguientes resultados: