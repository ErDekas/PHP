Aquí tienes el **README** completo y actualizado con todas las partes del proyecto:

---

# **Casino La Fortuna**

Este proyecto es una aplicación web que simula un casino básico utilizando la baraja española. Está desarrollado en **PHP** y sigue el patrón de diseño **MVC** (Modelo-Vista-Controlador).

---

## **Descripción del Proyecto**

El objetivo principal de esta aplicación es ofrecer una experiencia interactiva con la baraja española. Las funcionalidades principales incluyen:

1. **Mostrar todas las cartas de la baraja.**
2. **Seleccionar y mostrar una carta específica** (utilizando formularios con desplegables).
3. **Barajar las cartas** (mezclando el mazo y mostrando el resultado).
4. **Sacar una carta aleatoria** (mostrándola y eliminándola del mazo).
5. **Repartir cartas a varios jugadores** (con opción de elegir número de jugadores y cartas por jugador).

---

## **Estructura del Proyecto**

```
/
├── assets/                # Carpeta con imágenes de las cartas (bastos_1.jpg, copas_2.jpg, etc.)
├── Controllers/           # Controladores que gestionan la lógica de la aplicación
│   ├── BarajaController.php
│   └── HomeController.php
├── Core/                  # Núcleo de la aplicación
│   └── router.php         # Gestión de rutas y controladores
├── Models/                # Modelo de datos que representa la baraja española
│   └── Baraja.php
├── Views/                 # Vistas que presentan la información al usuario
│   ├── baraja/            # Vistas relacionadas con la baraja
│   │   ├── formCarta.php
│   │   ├── formRepartir.php
│   │   ├── mostrar.php
│   │   ├── mostrarCarta.php
│   │   ├── repartir.php
│   │   └── sacar.php
│   └── home/              # Página inicial
│       └── index.php
├── .htaccess              # Configuración de rutas amigables
└── index.php              # Punto de entrada principal
```

---

## **Requisitos**

1. Servidor web compatible con PHP (por ejemplo, XAMPP, WAMP, LAMP o similar).
2. PHP versión 7.4 o superior.
3. Extensión habilitada para sesiones (`session_start`).
4. Carpeta `/assets` con imágenes de las cartas en formato `palo_numero.jpg`.

---

## **Instalación y Configuración**

1. Clona este repositorio en tu servidor local.
2. Asegúrate de que las imágenes de las cartas están en la carpeta `/assets` con nombres como:
   ```
   bastos_1.jpg, bastos_2.jpg, ..., copas_12.jpg
   ```
3. Configura el servidor para que el documento raíz sea `index.php`.
4. Asegúrate de que el archivo `.htaccess` esté habilitado para manejar rutas amigables.
5. Inicia el servidor web y accede a la URL base del proyecto.

---

## **Páginas y Funcionalidades**

### **1. Página Principal**
Ubicación: `/views/home/index.php`

La página principal muestra el nombre del casino y enlaces a todas las funcionalidades:
- Mostrar cartas.
- Mostrar una carta específica.
- Barajar.
- Sacar una carta.
- Repartir cartas.

---

### **2. Mostrar Todas las Cartas**
Ubicación: `/views/baraja/mostrar.php`

Esta página muestra todas las cartas de la baraja española. Las imágenes se cargan dinámicamente desde la carpeta `/assets`.

---

### **3. Mostrar una Carta Específica**
Ubicación: `/views/baraja/formCarta.php` (Formulario) y `/views/baraja/mostrarCarta.php` (Resultado)

- El usuario selecciona un palo y un número de carta mediante desplegables.
- La aplicación muestra la carta correspondiente si existe.

---

### **4. Barajar las Cartas**
Ubicación: `/views/baraja/mostrar.php`

- Mezcla aleatoriamente las cartas de la baraja.
- Actualiza el mazo en la sesión para mantener el estado.
- Muestra todas las cartas en el nuevo orden.

---

### **5. Sacar una Carta**
Ubicación: `/views/baraja/sacar.php`

- Elimina una carta aleatoria del mazo y la muestra.
- Actualiza el mazo en la sesión para que la carta no vuelva a aparecer.
- Si no quedan cartas, muestra un mensaje indicando que la baraja está vacía.

---

### **6. Repartir Cartas**
Ubicación: `/views/baraja/formRepartir.php` (Formulario) y `/views/baraja/repartir.php` (Resultado)

- El usuario introduce el número de jugadores y la cantidad de cartas por jugador.
- La aplicación reparte las cartas de forma equitativa, eliminándolas del mazo.
- Muestra las cartas de cada jugador en listas individuales.

---

## **Detalles Técnicos**

### **Core/router.php**

El enrutador centraliza el manejo de rutas. Detecta el controlador y la acción solicitados a través de los parámetros `controller` y `action` en la URL.  
Por ejemplo:
```
http://localhost/?controller=baraja&action=mostrar
```
Carga el método `mostrar` del `BarajaController`.

Si no se especifican valores, se utiliza `HomeController` y el método `index` por defecto.

---

### **Modelo: Baraja.php**

El modelo `Baraja.php` maneja toda la lógica relacionada con la baraja española:

1. **Generar Mazo**: Genera un array con las 48 cartas de la baraja española.
2. **Barajar**: Mezcla aleatoriamente las cartas.
3. **Sacar Carta**: Extrae una carta del mazo y la elimina.
4. **Repartir**: Divide las cartas entre los jugadores seleccionados, eliminándolas del mazo.
5. **Sesiones**: Persiste el estado del mazo entre solicitudes utilizando `$_SESSION`.

---

### **Controladores**

#### **BarajaController.php**
- Gestiona las acciones relacionadas con la baraja (mostrar, barajar, sacar carta, repartir).

#### **HomeController.php**
- Gestiona la página principal del casino.

---

### **.htaccess**

Este archivo configura el servidor web para redirigir todas las solicitudes al `index.php`. Esto permite manejar rutas amigables y mantener el control de las solicitudes desde un único punto.

---

## **Uso del Proyecto**

1. Accede a la página principal del casino (`/views/home/index.php`).
2. Selecciona una funcionalidad desde los enlaces disponibles:
   - Mostrar todas las cartas.
   - Mostrar una carta específica.
   - Barajar las cartas.
   - Sacar una carta.
   - Repartir cartas.
3. Sigue las instrucciones en cada página para interactuar con la baraja.

---

## **Características Adicionales**

1. **Patrón MVC**: La aplicación separa la lógica de negocio (Modelo), la presentación (Vista) y el control de flujo (Controlador).
2. **Sesiones**: Se utiliza `$_SESSION` para mantener el estado de la baraja entre solicitudes.
3. **Flexibilidad**: Permite personalizar la interacción con el mazo (barajar, sacar, repartir).

---

## **Mejoras Futuras**

1. Implementar autenticación para permitir sesiones individuales por jugador.
2. Agregar estilos con CSS o frameworks como Bootstrap para mejorar la experiencia visual.
3. Incorporar funcionalidades adicionales como juegos de cartas (por ejemplo, mus o brisca).

---

## **Autor**

Este proyecto fue desarrollado como un ejemplo educativo. ¡Disfruta jugando en el **Casino La Fortuna**! 😊