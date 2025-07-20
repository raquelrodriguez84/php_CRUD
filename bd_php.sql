-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2025 a las 12:00:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(13, 50, '2025-02-03', 'ups'),
(14, 50, '2025-01-27', 'a ver '),
(33, 47, '2025-02-05', 'a ver'),
(34, 47, '2025-02-05', 'dr'),
(38, 50, '2025-02-07', 'yaa!'),
(44, 43, '2025-02-28', 'maria'),
(55, 51, '2025-02-20', 'cristina'),
(64, 59, '2025-02-19', 'a'),
(67, 48, '2025-02-20', 'MANUEL'),
(70, 53, '2025-03-04', 'carmen'),
(75, 48, '2025-03-06', 'manolo'),
(78, 36, '2025-03-12', 'Probar'),
(82, 47, '2025-02-01', 'asfdgas'),
(84, 127, '2025-03-21', 'revisar '),
(87, 47, '2025-02-01', 'ya'),
(88, 47, '2025-02-01', 'ya'),
(89, 134, '2025-05-01', 'Vacuna'),
(91, 135, '2025-05-01', 'revacuan'),
(92, 47, '2025-01-01', 'vacuna'),
(93, 47, '2025-03-01', 'revacuna'),
(96, 52, '2025-01-01', 'no lo pondre'),
(99, 52, '2025-03-12', 'Grodo'),
(100, 132, '2025-05-02', 'Loli'),
(103, 48, '2025-10-01', 'MANUEL'),
(104, 43, '2025-03-10', ' '),
(105, 47, '2025-12-12', ' no pelu'),
(108, 43, '2025-12-12', 'abc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticias` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha_noticia` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticias`, `titulo`, `imagen`, `texto`, `fecha_noticia`, `idUser`) VALUES
(3, 'Si tienes este mítico móvil, puedes ganar más de 100.000 euros', 'movil.jpg', 'Actualmente, los coleccionistas están dispuestos a pagar una suma importante de dinero por un teléfono inteligente antiguo, por lo que es recomendable revisar los móviles que tengas antiguos y comprobar si tienen un valor especial. El mercado de los teléfonos antiguos está viviendo un gran crecimiento, sobre todo por parte de los coleccionistas que están dispuestos a desembolsar grandes sumas de dinero por adquirir algunos modelos específicos.\r\n\r\nUn auténtico dineral por un teléfono antiguo\r\nUn iPhone 2G, aún cubierto con su caja y funda, se vendió recientemente en una subasta por casi 180.000 euros, según recoge el medio danés Nyheder24. Esto demuestra que ciertos modelos antiguos ya no son un simple aparato electrónico sin uso, sino que en algunos casos puede significar un verdadero tesoro.\r\n\r\n\r\n\r\nLos modelos de Apple, pese a ser la marca de teléfonos más reconocida, no es la única marca que posee móviles antiguos que llaman la atención de los coleccionistas. En este sentido, existen modelos más antiguos, como el Nokia 3310 y el Ericsson T28, que también han aumentado significativamente su valor en el mercado.\r\n\r\nEl Nokia 3310, caracterizado por su robustez y diseño simple, puede llegar a alcanzar un precio de venta en torno a 200 euros, ya que es uno de los teléfonos más emblemáticos desde que se crearon los teléfonos inteligentes. Estos modelos antiguos atraen el interés de los coleccionistas individuales, pero también de los museos dedicados al sector tecnológico, que quieren mostrar el desarrollo de la tecnología con el paso del tiempo. Por tanto, si aún posees un IPhone 2G puedes venderlo en algunas casas de coleccionistas por más de 1.000 euros, que sigue siendo una importante suma de dinero, dado el aparato que es.', '2025-03-09', 36),
(4, 'Estado de salud del papa Francisco', 'elVaticano.jpg', 'El papa Francisco presentó este sábado &quot;una mejora gradual y leve&quot;, tal y como se difundió en el último parte médico hecho público este sábado por la tarde. Los médicos dicen que las condiciones clínicas del papa se mantienen estables: &quot;Dan testimonio de una buena respuesta a la terapia&quot;.\r\n\r\nFrancisco sigue sin fiebre, el intercambio gaseoso ha mejorado, y su analítica y su hemograma son estables. En cualquier caso, el pronóstico es aún reservado.\r\n\r\nEste domingo, en el que Francisco se ha despertado tras pasar una &quot;noche tranquila&quot;, se cumplen 24 días de su ingreso en el hospital Gemelli de Roma, una cifra sin precedentes en un papado (Juan Pablo II estuvo 21 días internado tras el atentado contra su vida en 1981.', '2025-03-09', 36),
(5, 'La reserva de criptomonedas de EEUU hunde al bitcoin', 'monedas.jpg', 'Donald Trump volvió a agitar ayer los mercados, aunque esta vez su principal víctima fueron las divisas digitales. Si bien las criptomonedas gozaron del impulso de la vuelta del presidente americano, y en el caso de bitcoin superó los niveles de los 100.000 dólares durante varias jornadas, las últimas decisiones de Trump desinflaron las expectativas en torno al activo digital y la empujaron en dirección contraria.\r\n\r\nEl último episodio de descensos significativos de las criptomonedas tuvo lugar ayer, cuando se publicó la orden ejecutiva que dará pie a la creación de una Reserva Estratégica de Criptomonedas y una Reserva de Activos Digitales de los Estados Unidos. Dicha provisión se construirá a base de bitcoin, ethereum, Solana y XRP, entre otras. Y precisamente fueron estas las siguientes protagonistas a la orden de la Reserva de la Casa Blanca: el bitcoin, por ejemplo, llegó a caer un 5,7% en los minutos siguientes al anuncio del Gobierno estadounidense. En la media jornada de Wall Street, sus pérdidas se redujeron hasta el 3%, según recogía Bloomberg, lo que situaba su precio de cotización en los 87.125 dólares (cuando la jornada anterior superaba los 89.900 dólares).\r\n\r\nLas responsables de estas caídas fueron, de nuevo, las perspectivas: &quot;Es un tema de expectativas. El mercado estaba esperando que en la firma de Trump anunciase cuáles iban a ser las posiciones del Gobierno, y cuántas iban a ser las compras que se iban a planificar&quot; explica Javier Pastor, director de Formación Institucional de Bit2Me. Y si bien en la orden firmada ayer por Trump se explicaban algunas cuestiones sobre el depósito de activos digitales, como un plazo de 60 días para que el Secretario del Tesoro (ahora el multimillonario Scott Bessent) entregue las consideraciones legales y de inversión para la gestión de las reservas de monedas digitales, así como que será tarea del mismo establecer una oficina para administrar los depósitos de moneda digital, hubo cuestiones que quedaron sin resolver.\r\n\r\nFue a través de las redes sociales como, minutos después de la firma de la orden ejecutiva, David Sacks (el bautizado como zar de la Casa Blanca en materia de inteligencia artificial y criptomonedas) explicó en su cuenta de X que el país &quot;no venderá ningún bitcoin depositado en la reserva&quot;, sino que se mantendrá &quot;como una reserva de valor&quot;. Asimismo, y entre otras medidas, el portavoz del Gobierno estadounidense ordenó una contabilidad completa de las tenencias de activos del gobierno, que se estimarían en alrededor de 200.000 bitcoins.\r\n\r\n&quot;Van a paralizar cualquier movimiento de venta que pueda haber en ese sentido. Si el mercado tenía una expectativa de un anuncio de compras con una planificación, pues no lo ha hecho. Y el mercado ha tenido una reacción negativa, pero en el corto plazo&quot; puntualiza Pastor, que explica que en el vaivén del mercado durante el día, los precios han oscilado entre los 86.000 dólares, llegando incluso a regresar a los 90.000 en la constante volatilidad de la divisa.\r\n\r\nUn punto de inflexión\r\nPastor destaca otra cuestión de la jornada de ayer: el gesto que hizo el Gobierno de EEUU ayer a la hora de establecer una reserva estratégica de criptodivisas dentro de los activos del Tesoro estadounidense. &quot;En el momento en el que EEUU valida o determina que bitcoin es un activo estratégico, y otros activos también, le da una carta de reconocimiento&quot; que lo encamina a convertirse en una herramienta complementaria a las finanzas gubernamentales.\r\n\r\n&quot;Esto es un punto de inflexión, y un antes y un después en el significado de los criptoactivos a nivel global&quot;, asegura el portavoz de Bit2Me, que celebra también la primera criptocumbre en la Casa Blanca como &quot;hito&quot; y señal de que el bitcoin y los activos digitales puedan adquirir un papel más representativo dentro de las finanzas públicas de los distintos países.', '2025-03-09', 36),
(6, 'La Policía Local de Valencia detiene a un conductor de patinete', 'patinete.jpg', 'Agentes de la Unidad de Seguridad, Apoyo y Prevención de la Policía Local de Valencia (USAP) han detenido a un hombre que circulaba en patinete eléctrico. La intercepción se produjo en la calle Beltrán Báguena, en el Centro Comercial Nuevo Centro. Observaron que tenía una actitud sospechosa y lo acabaron deteniendo por traficar hachís. Además, descubrieron que el patín que montaba era robado.\r\n\r\nLa Policía Local de Valencia ha compartido esta detención en su perfil de X (antes Twitter), con un texto que ha llamado la atención de los usuarios: «Agentes de la USAP interceptan, en la calle Beltrán Báguena, a un hombre que traficaba con hachís con un patín presuntamente robado. El conductor dio positivo en drogas. Se quedó sin la droga, sin el patín y con varias cuentas pendientes…«.', '2025-03-09', 36),
(7, 'Muface, noticias en directo: acaba la semana que tuvo en vilo al mutualismo', 'seguro.jpg', 'Se cierra una nueva semana que ha mantenido en vilo al mutualismo de nuestro país. Asisa y Adeslas ya han anunciado su &#039;sí&#039; a Muface. Ambas aseguradoras serán las encargadas de prestar asistencia sanitaria a miles de beneficiarios y mutualistas tras aceptar las condiciones propuestas por el Ministerio de Función Pública, dirigido por Óscar López.\r\n\r\nSin embargo, el último fleco, DKV, no seguirá. Y, aunque la crisis parece haber llegado a su fin, todavía quedan numerosas incógnitas por resolverse. Entre ellas, cómo se repartirán los beneficarios de DKV. \r\n\r\nPero el siguiente paso lo deberá dar la dirección general de Muface. Su cúpula decidirá si las condiciones propuestas por Asisa y Adeslas, las dos protagonistas en este momento, son las adecuadas.\r\nAsisa y Adeslas, a la salvación de Muface\r\n\r\nTras más de cinco meses de incertidumbre, Asisa y Adeslas han sido las dos únicas compañías que han presentado sus ofertas a la ya tercera licitación del concierto sanitario de Muface. Con ello, el modelo de sanidad privada de la mutualidad pasaría de tres a dos entidades tras la salida de DKV que abandonó la puja por el contrato. El nuevo convenio, que durará tres años, hasta el 31 de diciembre de 2027, dispone de una cuantía económica que asciende hasta los 4.808,5 millones de euros. Un aumento de la prima del 41,2 por ciento respecto al último concierto. Además, el movimiento de estas dos aseguradoras, a falta de que la Dirección General del modelo revise las ofertas, supondría el fin de una crisis sin precedentes que comenzó en octubre. ', '2025-03-09', 36),
(15, 'La nieve llega a Madrid: 20 centímetros de acumulaciones a partir de este día', 'monk-7010969_1280.jpg', 'La llegada de una borrasca atlántica este fin de semana provocará una bajada de las temperaturas en toda la península, este descenso irá acompañado de una serie de precipitaciones en forma de nieve, que se notarán en la Sierra de Madrid. Estas nevadas serán principalmente en cotas bajas. Este temporal se suma a una serie de precipitaciones que están asolando España. Desde la AEMET (Agencia Estatal de Meteorología) han lanzado un comunicado advirtiendo de la llegada de esta nueva borrasca.\r\n\r\nEstas nevadas comenzarán el sábado, con una cota en torno a los 1.200 metros, acumulando la mayor cantidad de nieve por encima de los 1.500 metros. Ya el domingo la cota de nieve podría descender hasta los 1.000 metros o incluso los 900 metros, dejando nieve en localidades como Cercedilla, Navacerrada, Somosierra o Guadarrama.', '2025-03-09', 36),
(16, 'Llegan ocho nuevos emojis y uno de ellos promete ser de los más usados', 'emoji.jpg', 'Esta semana, el gigante tecnológico Apple ha anunciado los nuevos ocho emojis que vienen incluidos en la nueva actualización de su sistema operativo, iOS 18.4, en versión beta.\r\n\r\nEstas son las imágenes: un rostro ojeroso y con cara de sueño; una huella dactilar; una mancha de pintura morada; un rábano; un tronco sin hojas; un arpa; una pala y la bandera de Sark (la más pequeña de las islas del canal de la Mancha, que pertenece a Reino Unido).\r\n\r\nTal y como recoge el Daily Mail, muchos usuarios de redes sociales han aplaudido la creación de un emoticono que muestre los efectos en el rostro del cansancio y el estrés.\r\nLos fans de la cerveza Guinness, por su parte, han aplaudido el emoji del arpa. Aunque hace referencia al instrumento musical, el arpa es uno de los símbolos de Irlanda y es el logotipo de la famosa cerveza negra fabricada en Dublín.\r\n\r\nEn cuanto a la bandera de la isla de Sark, esta inclusión ha sorprendido a muchos, porque que en marzo de 2022, Unicode anunció que ya no aceptaría propuestas de &quot;emojis de bandera de ninguna categoría&quot;.', '2025-03-09', 36),
(17, 'La borrasca Jana se debilita pero las intensas lluvias dejan crecidas', 'lluvia.jpg', 'La borrasca atlántica de alto impacto Jana ha comenzado a debilitarse este domingo en España, aunque las intensas lluvias, las precipitaciones de nieve y los fuertes vientos, en algunos casos con rachas huracanadas, siguen siendo hoy protagonistas de una jornada marcada por la inestabilidad.\r\n\r\nComo consecuencia de las intensas precipitaciones que se han registrado durante las últimas horas, numerosos ríos han sufrido importantes crecidas y el desbordamiento de sus márgenes habituales, por lo que se han intensificado los sistemas de observación y vigilancia ante las inundaciones que se están produciendo en muchos lugares.\r\n\r\nAunque once comunidades autónomas amanecieron este domingo en alerta ante las precipitaciones de lluvia, de nieve, el fuerte viento o el oleaje, las adversidades meteorológicas han ido remitiendo conforme avanzaba el día, y ya solo siete comunidades mantienen algún tipo de aviso, por lo que los diferentes servicios de emergencias han ido rebajando o desactivando los distintos niveles de alerta.\r\n\r\nContinúan todavía activos los avisos &#039;amarillos&#039; (riesgo) por fuerte oleaje en Andalucía, Cataluña, Galicia, Murcia, Valencia y Canarias; y por fuertes lluvias y tormentas en la ciudad de Ceuta y en Andalucía, donde además se mantienen las alertas por las nevadas (en Granada).\r\nRachas de viento de 239 km/h en La Covatilla\r\nLa profunda borrasca, que azota al país desde el viernes, seguirá perdiendo intensidad a partir del lunes, aunque continuarán las precipitaciones generalizadas, más probables e intensas en el cuadrante suroeste, y a lo largo del martes se disipará, aumentando la estabilidad y remitiendo las precipitaciones.\r\n\r\nDurante las últimas horas se han registrando todavía numerosas incidencias en muchos puntos del país, y en la estación de esquí de La Covatilla, en la provincia de Salamanca, se han producido rachas de viento que han anotado 239 kilómetros por hora.\r\n\r\nPor encima de los 100 kilómetros por hora ha habido también rachas de viento en Cerler (Huesca), en Fisterra (A Coruña) o en Cap de Vaquéira (Lleida), según los datos recopilados por la Agencia Estatal de Meteorología a primera hora de la mañana.\r\n\r\n', '2025-03-09', 36),
(18, 'La Mancomunidad de Tierras Altas pone en marcha varios puntos de observación de la naturaleza', 'naturaleza.jpg', 'El 23 de diciembre de 2021 se publicó el Acuerdo de la Conferencia Sectorial de Turismo, por el que se adjudicó a la Mancomunidad de Tierras Altas un Plan de Sostenibilidad por un total de 2.956.866 €. Entre las actuaciones aprobadas en este proyecto se planteaba la adecuación de puntos de observación (fauna, ornitología, starligth), para lo que se encargó a una empresa especializada un estudio en el que se localizaran los enclaves de mayor relevancia o interés natural. A partir de ese trabajo, se licitó la ejecución un proyecto ambicioso, tanto por el número de localizaciones y elementos incluidos, como por la extensión del área en la que se actuaría. El encargado de llevar a cabo estos trabajos ha sido la empresa Pronatura, Señalización y Equipamientos para Entornos Naturales S.L. que a lo largo de los últimos meses ha materializado las diferentes acciones.\r\nEl resultado ha sido la puesta en valor de una serie de puntos concretos o a lo largo de itinerarios que ya estaban señalizados que tienen interés en algunos de los aspectos ambientales que se consideraron de mayor valor natural y potencial turístico (aves, fauna, geología, botánica, astroturismo…) y el acondicionamiento de los mismos mediante elementos de seguridad, accesibilidad, señalización interpretativa o direccional…\r\n\r\nEstos son los espacios que se han habilitado:\r\n\r\n-Punto de observación de berrea y mamíferos: En el paraje de las Viñas, en el término municipal de Yanguas.\r\n\r\n-Miradores estelares: En las localidades de Valdeprado y Sarnago y en los despoblados de Aldealcardo y Torretarrancho.\r\n\r\n-Senda del Cidacos: por la orilla del río Cidacos a su paso por Yanguas.\r\n\r\n-Miradores: en Aldealices, Castillejo de San Pedro, en el nacimiento del río Cidacos (término municipal de las Aldehuelas) y mejora del ya existente en el puerto de Oncala.\r\n\r\n-Senda botánica del bosque Atlántico: junto a la localidad de Diustes\r\n\r\n-Senda botánica del Cañón del río Baos: en el término municipal de Villar del Río, cerca de Bretún\r\n\r\n-Senda botánica, ornitológica y geológica ribera del río Linares: en San Pedro Manrique.\r\n\r\n-Senda botánica del acebal de Oncala: junto a la localidad de Oncala.\r\n\r\nDentro de los recursos con los que cuenta la comarca de las Tierras Altas de Soria destaca su medio natural, caracterizado por la variedad de especies vegetales y animales fruto de la gran variedad de ecosistemas presentes en el territorio, derivados a su vez del alto contraste altitudinal y complejo relieve del espacio. Desde las praderas y matorrales de alta montaña, pasando por los bosques atlánticos, pinares naturales y de repoblación, robledales, encinares y encontrándose en las partes más bajas comunidades de matorrales y aromáticas netamente mediterráneas. Igual sucede con la geología, con interesantes formaciones y variedad de paisajes. Y con los cielos, favorecidos por el hecho de ser una de las zonas menos pobladas de Europa, con una escasa contaminación lumínica y atmosférica que permiten una perfecta observación nocturna del firmamento.', '2025-03-10', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `fechaNac` date NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `sexo` enum('Femenino','Masculino','No contesta') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fechaNac`, `direccion`, `sexo`) VALUES
(36, 'Raquel', 'Rodriguez garcia', 'rakela290@gmail.com', '617116677', '1984-09-08', 'Calle Hacho,', 'Femenino'),
(42, 'Pedro Manuel', 'Trujillo Medina', 'ptm@ptm.com', '617112234', '1982-07-26', 'Calle Hacho,', 'Masculino'),
(43, 'Maria Micaela', 'Garcia Garcia', 'mg@mg.com', '678086177', '1962-09-29', 'calle gordita, nº 62', 'Femenino'),
(47, 'Rafael', 'Rodriguez Arroyo', 'ra@ra.com', '677010203', '1961-02-21', 'Calle Pulidos, nº 14', 'Masculino'),
(48, 'Manuel', 'Rodriguez Garcia', 'mr@mr.com', '662020296', '1996-02-02', 'calle copo, n º28', 'Masculino'),
(50, 'Daniel ', 'Trujillo Medina', 'dt@dt.com', '696100986', '1987-09-10', 'c/Cuñado, nº 37', 'Masculino'),
(51, 'Cristina', 'Bueno Gonzalez', 'cb@cb.com', '617210530', '1994-05-21', 'Calle cuñiporri, nº 30', 'Femenino'),
(52, 'Laura ', 'Leiva Medina', 'lm@lm.com', '660130732', '1992-07-13', 'CalleGordo, nº 32', 'Femenino'),
(53, 'Carmen', 'Rodriguez Rodriguez', 'cr@cr.com', '651130842', '1982-07-13', 'Calle Primis, nº 42', 'Femenino'),
(54, 'Francisco', 'Ortigosa ortiz', 'fr@fr.com', '667788999', '1970-12-12', 'calle amparito aguilar, nº 45', 'Masculino'),
(59, 'Federico', 'Garcia Lorca', 'fg@fg.com', '617223344', '1954-02-28', 'Calle Garcia Lorca, nº 5', 'Masculino'),
(75, 'Churrete', 'Rodriguez Arroyo', 'cra@cra.com', '667714101', '2016-02-14', 'C/Pulidos, nº 14', 'Masculino'),
(78, 'Togo', 'Rodriguez Garcia', 'tt@tt.com', '617010305', '2020-03-01', 'Calle Hacho,', 'Masculino'),
(127, 'Luis Miguel', 'Alfonso Herrerito', 'luis@luis.com', '617888977', '1982-12-10', 'Calle Porteria, n8,', 'Masculino'),
(128, 'Lorenzo', 'Jaime Castillo', 'loren@loren.com', '635123456', '1979-06-30', 'Calle Loren, nº30', 'Masculino'),
(129, 'Hugo', 'Terrones Bueno', 'hugo@hugo.com', '677223344', '1980-01-31', 'Calle El Tarugo, nº12', 'Masculino'),
(132, 'Loli', 'Fernandez Fernandez', 'loli@loli.com', '688997799', '1999-05-30', 'CALLE ALAMEDA, N1', 'Femenino'),
(134, 'Ruben', 'Trujillo Rodriguez', 'ru@ben.com', '687910201', '2017-06-08', 'C/ Dragon Ball Z, nº87', 'Masculino'),
(135, 'Valeria', 'Trujillo Rodriguez', 'va@le.com', '610444667', '2018-09-06', 'C/ Videl, nº6', 'Femenino'),
(136, 'Silvia', 'Jimenez Martinez', 'sil@sil.com', '688776655', '1976-03-24', 'c/ clinica, nº 2', 'Femenino'),
(138, 'Ana', 'Garcia Molina', 'an@an.com', '717616323', '1930-09-29', 'C/ La caminera, n2', 'Femenino'),
(146, 'VERONICA', 'Padilla Torres Alarcon', 'vero@vero.es', '952334545', '1979-12-01', 'C/ Señor de la Veronica, bloque 4, 3ºa', 'Femenino'),
(147, 'Idelfonso', 'Verdun Bernal', 'ide@ide.com', '678592792', '2021-12-31', 'C/ Pelusito, nº 4', 'Masculino'),
(148, 'David', 'Lozano Ferrari', 'david@david.com', '941234568', '2000-10-17', 'C/ Revisar, nº 123', 'Masculino'),
(149, 'Lucas', 'Gonzalez Pereira', 'lu@lu.com', '677554433', '1999-11-24', 'C/ Lucas Lucas, n8', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('USER','ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `contrasena`, `rol`) VALUES
(1, 36, 'rakela290@gmail.com', '$2y$10$0aApVEa6egXJ6dYpSyZDducBdrgn6XSoYb2TmX4EwTJtuX5WzSnVu', 'ADMIN'),
(4, 42, 'ptm@ptm.com', '$2y$10$g4vhvF4YGl3/Clp0iJTVhuCK3ckmKoPdKz9J3QFdaTijGq8csIXI.', 'ADMIN'),
(5, 43, 'mg@mg.com', '$2y$10$4GUKNKBR8EUGPsuP8QX87.1eb/rKnpL58gKM8tB.BV1bw9/los.qC', 'USER'),
(8, 47, 'ra@ra.com', '$2y$10$tQN5/KBIxGD3oNXwa5lqcer.Mzj90ICgvdbmrRs5e7T5pCaMQaj6a', 'USER'),
(9, 48, 'mr@mr.com', '$2y$10$lhBOYNZTgSvbuKlX917HkO4FFBngvdR2VYHtNOcyDGjpNEIeqxXGK', 'USER'),
(11, 50, 'dt@dt.com', '$2y$10$nt7VEKKVLEe.ir8P07txJ.yY1O9o1bYPV7cZYvi9J40xawUt9bsae', 'USER'),
(12, 51, 'cb@cb.com', '$2y$10$3FBQ3fXQn9F61oC/PxDP0uWiAHBCpXGDpCVV825kwN/tno47ViFD2', 'USER'),
(13, 52, 'lm@lm.com', '$2y$10$mF7haE2hs.hdLY2oXbBP1eZ6685viRbk7ZA9V8i4RsRZIgmCuVcku', 'USER'),
(14, 53, 'cr@cr.com', '$2y$10$GbnwbfrjA.o.l3W3s1ZQo.6szOKWl1RZDpQBXvhQjLyZ5SmKsvnGq', 'USER'),
(15, 54, 'fr@fr.com', '$2y$10$RaDtUxblSyz7Rp4to..6EOEXH4Zc2Heyd9B0UQCVuC4Ok1Zl0AJO6', 'USER'),
(18, 59, 'fg@fg.com', '$2y$10$3GX4LAEiDVhtSU69.Rtmq.gQrpnVtfWKBOZ4lYY2Ei0oB0I8AScYy', 'USER'),
(23, 75, 'cra@cra.com', '$2y$10$jO0Fc6hy7QJ.AACEwebkY.XGVnMWN3xeYSCW8S57/zkWxA8r9WBxe', 'USER'),
(25, 78, 'tt@tt.com', '$2y$10$tNwk3xS4o1nXAjpBA5EE2eqJmew7LXBDHfURg0nMIdgol2TCK1aMO', 'USER'),
(61, 127, 'luis@luis.com', '$2y$10$qoMThVofbew5slAR9BaFC.UTQ1oTpcH3d5EuFpXXFro78jkoEJezq', 'USER'),
(62, 128, 'loren@loren.com', '$2y$10$98UMizoBZrJis9iaM2S7feQUZ6ag8Ec9j4mhTHpine30eA6pBEq46', 'USER'),
(63, 129, 'hugo@hugo.com', '$2y$10$2lv3Fe7CZdtRkQIxeOphAOb2jUBHOHi5Nir3J5CCFzSFREOuhs0N.', 'USER'),
(64, 132, 'loli@loli.com', '$2y$10$E30CDXT5FatZb3XOzcDeiOwGqntRz5sl879wZkFpAxkUDoQDbakf2', 'USER'),
(66, 134, 'ru@ben.com', '$2y$10$ukcmB6xyOksF8NiBmbBmoe5vFrr4prTumj5Rknp96olWpScUc4p9i', 'USER'),
(67, 135, 'va@le.com', '$2y$10$t7SJYMJENbnMHmmEreSgZ.6LvEQjBgwuCGhw.GTU25J0g3kQl/5NW', 'USER'),
(68, 136, 'sil@sil.com', '$2y$10$fcCWvNwz7OByld0U4VnOqe22niBDwJffF5QP1rRUzE8qHpKD3IJQu', 'USER'),
(70, 138, 'an@an.com', '$2y$10$CLn72iv054i.eV6Zgv8xSOSNxcx.fwoUNktByIfzSq6jVhPaWihDC', 'USER'),
(71, 146, 'vero@vero.es', '$2y$10$rLRQn94/ocKol/J6fT0Qdu7k4aFyTLw/qtON96csdQwmwXrNryRBu', 'USER'),
(72, 147, 'ide@ide.com', '$2y$10$qZ5RBUtEKi9.cFQ9OMUTEu7oB4mqvfHLLwYMVIXWH7xj8yD57IWfq', 'USER'),
(73, 148, 'david@david.com', '$2y$10$1Q0Ccy8fghNvFb8pkq5ULuKJvi6VZgUPESmivsD6rnNuXU1ufrVIi', 'USER'),
(74, 149, 'lu@lu.com', '$2y$10$q1PozEXgoJ/3nsRQi7H9FutycsqtGsuvdHtrVNvpob9XAsWOKrkiG', 'USER');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticias`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
