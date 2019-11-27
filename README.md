# IIS

IIS: Sport: správa turnajů, registrace hráčů a zadávání výsledků

<table cellpadding="2" style="max-width: 700px"><tbody><tr><td><b>Společná část popisu:</b></td></tr>
<tr><td><b>1. Výběr zadání</b><br><br>Vytvořte tříčlenné (preferované), případně dvoučlenné týmy. Vedoucí týmu se přihlásí na jednu z šesti variant. Nejpozději do <b>1. 11. 2019</b> se členové týmu ujistí, že spolupráce funguje, nejlépe tím, že začnou na projektu pracovat. Do tohoto termínu lze měnit týmy a zadání. Po tomto datu již změny nejsou možné                         
 - projekt by se již pravděpodobně nestihl dokončit. Ostatní problémy v                         
 týmu budou řešeny individuálně.<br><br><b>2. Cíle projektu</b><br><br>Cílem projektu je navrhnout a implementovat informační systém s webovým rozhraním pro zvolené zadání jedné z variant. Postup řešení by měl být následující:<br><ol><li>Analýza a návrh informačního systému (analýza požadavků, tvorba diagramu případů užití, modelu relační databáze)</li><li>Volba implementačního prostředí - databázového serveru a aplikační platformy</li><li>Implementace navrženého databázového schématu ve zvoleném DB systému</li><li>Návrh webového uživatelského rozhraní aplikace</li><li>Implementace vlastní aplikace</li></ol><p><b>3. Rozsah implementace</b><br><br>Implementovaný systém by měl být prakticky použitelný pro účel daný zadáním. Mimo jiné to znamená:</p><ul><li>Musí umožňovat vložení odpovídajících vstupů.</li><li>Musí poskytovat výstupy ve formě, která je v dané oblasti                                               
využitelná. Tedy nezobrazovat obsah tabulek databáze, ale prezentovat                                               
uložená data tak, aby byla pro danou roli uživatele a danou činnost                                               
užitečná (např. spojit data z více tabulek, je-li to vhodné, poskytnout                                               
odkazy na související data, apod).</li><li>Uživatelské rozhraní musí umožňovat snadno realizovat operace pro                                               
každou roli vyplývající z diagramu případů použití (use-case). Je-li                                               
cílem např. prodej zboží, musí systém implementovat odpovídající                                               
operaci, aby uživatel nemusel při každém prodeji ručně upravovat počty                                               
zboží na skladě, pamatovat si identifikátory položek a přepisovat je do                                               
objednávky a podobně.</li></ul><p>Kromě vlastní funkcionality musí být implementovány následující funkce:</p>                                           
<ul><li>Správa uživatelů a jejich rolí (podle povahy aplikace, např.                                            
obchodník, zákazník, administrátor). Tím se rozumí přidávání nových                                            
uživatelů u jednotlivých rolí, stejně tak možnost editace a mazání nebo                                            
deaktivace účtů. Musí být k dispozici alespoň dvě různé role uživatelů.</li><li>Ošetření všech uživatelských vstupů tak, aby nebylo možno zadat nesmyslná nebo nekonzistentní data.                                           
	<ul><li>Povinná pole formulářů musí být odlišena od nepovinných.</li><li>Hodnoty ve formulářích, které nejsou pro fungování aplikace                                            
nezbytné, neoznačujte jako povinné (např. adresy, telefonní čísla apod.)                                           
 Nenuťte uživatele (opravujícího) vyplňovat desítky zbytečných řádků.</li><li>Při odeslání formuláře s chybou by správně vyplněná pole měla                                            
zůstat zachována (uživatel by neměl být nucen vyplňovat vše znovu).</li><li>Pokud je vyžadován konkrétní formát vstupu (např. datum), měl by být u daného pole naznačen.</li><li>Pokud to v daném případě dává smysl, pole obsahující datum by měla být předvyplněna aktuálním datem.</li><li>Nemělo by být vyžadováno zapamatování a zadávání generovaných                                            
identifikátorů (cizích klíčů), jako např. ID položky na skladě. To je                                            
lépe nahradit výběrem ze seznamu. Výjimku tvoří případy, kdy se zadáním                                            
ID simuluje např. čtečka čipových karet v knihovně. V takovém případě                                            
prosím ušetřete opravujícímu práci nápovědou několika ID, která lze                                            
použít pro testování.</li><li>Žádné zadání nesmí způsobit nekonzistentní stav databáze (např. přiřazení objednávky neexistujícímu uživateli).</li></ul>                                           
</li><li>Přihlašování a odhlašování uživatelů přes uživatelské jméno a heslo. Automatické odhlášení po určité době nečinnosti.</li></ul><p><b>4. Implementační prostředky</b><br><br><u>3.1 Uživatelské rozhraní                                
</u></p><ul><li>HTML5 + CSS, s využitím JavaScriptu, pokud je to vhodné. Je povoleno                                
 využití libovolných volně šířených JavaScriptových a CSS frameworků                                 
(jQuery, Bootstrap, atd.)</li><li>Případně lze využít i AJAX či pokročilejší klientské frameworky (Angular, React, apod.), není to ale vyžadováno.</li></ul>                                
<p>Rozhraní musí být funkční přinejmenším v prohlížečích Chrome, Firefox a Internet Explorer.</p>                                
                                
<u>3.2 Implementační prostředí                                
</u><ul><li>PHP + MySQL (server eva nebo jiný dostupný), případně libovolný open source PHP framework.</li><li>Alternativně jiná serverová technologie (např. Java, .NET, Python,                                 
Ruby, apod.) - domluvte se na detailech (viz kontakt níže).</li></ul>                                
<p>Při použití relační databáze <b>specifikujte integritní omezení</b>                                
 (např. unikátní hodnoty, cizí klíče, apod.) při vytváření databáze.                                 
Neponechávejte zajištění konzistence dat pouze na aplikaci. V MySQL je k                                
 tomu třeba použít tabulky typu InnoDB (typ je možno zvolit při                                 
vytváření tabulky nebo změnit dodatečně).</p>                                
<p>Použití jiné platformy je možné, ale je nutné se předem domluvit se                                 
cvičícím a samostatně si zajistit umístění vytvořené aplikace, aby bylo                                 
možno ji předvést.</p><p><b>5. Dokumentace                           
</b></p><p>Součástí projektu je stručná dokumentace k implementaci, která                            
popisuje, které PHP skripty (případně kontrolery, presentery apod. podle                           
 zvoleného frameworku) implementují jednotlivé případy použití. Tato                            
dokumentace je součástí dokumentu <u>doc.html</u>, viz níže.</p><p><b>6. Odevzdání </b>                     
</p><p>Odevzdání probíhá přes IS FIT. Od okamžiku odevzdání nejméně do                       
<b>31. 1. 2020</b> musí být dále funkční aplikace přístupná přes síť Internet na                       
některém fakultním nebo jiném serveru. Tato aplikace musí umožňovat                       
přihlášení pod všemi rolemi uživatelů a musí být naplněna ukázkovými                       
daty, na kterých lze vyzkoušet všechny funkce. Pokud je to technicky                       
možné, použijte umístění <u>http://www.stud.fit.vutbr.cz/~xlogin00/IIS</u>.                      
 Vyhnete se případným problémům s funkčností hostingu. Výjimku tvoří                       
předem domluvená a individuálně předvedená řešení na exotických                       
platformách.</p>                      
<p>Přes IS se odevzdává jeden archiv pojmenovaný <u>vas_login.zip</u> obsahující:</p>                      
<ul><li>Všechny zdrojové kódy a datové soubory aplikace. Vzhledem                      
 k limitu velikosti odevzdaného souboru ve WISu (2 MB) odevzdávejte                       
pouze vlastní kód a data. Neodevzdávejte prosím kódy použitých knihoven a                      
 frameworků třetích stran. Místo toho uveďte pouze jejich verze v                       
dokumentaci.</li><li>SQL skript nebo jiný prostředek pro vytvoření a inicializaci schématu databáze.</li><li>Soubor <u>doc.html</u> obsahující dokumentaci. Stáhněte si <a href="https://www.fit.vutbr.cz/study/courses/IIS/private/projekt/doc.html">šablonu dokumentace</a>,                      
 editujte a přiložte k odevzdanému projektu. Respektujte prosím pokyny                       
obsažené v tomto souboru. Některé pokyny mají formu komentářů v HTML                       
kódu šablony.</li></ul>                      
<p>Za každý tým odevzdává pouze <b>vedoucí týmu</b>.</p>                      
<p>Termín pro odevzdání do IS FIT je <b>2. 12. 2019</b>. Po tomto termínu již nelze projekt akceptovat.</p><b>                      
                      
7. Body                      
</b><p>Za projekt je možno získat až 30 bodů.</p><p><b>8. Kontakt</b></p><p>Jiří Hynek (<a href="mailto:ihynek@fit.vut.cz">ihynek@fit.vut.cz</a>)</p></td></tr>
<tr><td><b>Popis varianty:</b></td></tr><tr><td>Úkolem zadání   
je vytvořit informační systém pro pořádání sportovních   
turnajů mezi jednotlivci nebo týmy vyřazovacím herním stylem   
<a href="https://cs.wikipedia.org/wiki/Vy%C5%99azovac%C3%AD_syst%C3%A9m">pavouk</a>   
(pro řešení zvolte jeden vhodný sport, který je možné hrát   
jak mezi jednotlivci, tak i mezi týmy - například tenis nebo   
počítačová hra AOE II). Každý turnaj má nějaké označení,   
pomocí kterého ho uživatelé systému budou moci vhodně odlišit   
a další atributy (např. cena, možní sponzoři, apod.). Dále   
stanovuje podmínky, za jakých se mohou turnajů účastnit   
jednotlivé týmy - např. počet týmů, vlastnosti týmů (počet   
hráčů, typ hráčů apod.), registrační poplatek. Dále obsahuje   
dodatečné vlastnosti popisující turnaj jako například cena,   
případné sponzory apod. Každý tým má vlastní název a   
volitelně logo (např. vlajku). Uživatelé budou moci informační   
systém použít jak pro registraci na turnaj, tak tvorbu a správu   
turnajů nových, správu týmů a účastníků turnaje - a to   
následujícím způsobem:   
<ul><li>   
<p><b>administrátor:</b></p>   
	<ul><li>   
<p>spravuje   
		uživatele</p>   
		</li><li>   
<p>má práva   
		všech následujících rolí</p>   
	</li></ul>   
	</li><li>   
<p><b>registrovaný   
	uživatel:</b></p>   
	<ul><li>   
<p>zakládá   
		a spravuje týmy, registruje se do týmů</p>   
		</li><li>   
<p>registruje   
		sebe nebo svůj tým na turnaj, v&nbsp;kterém daný uživatel   
		(příp. člen týmu) nefiguruje jako rozhodčí - stává se   
		<b>hráčem turnaje</b></p>   
		<ul><li>   
<p>účastní   
			se zápasů, jsou mu generovány statistiky na základě těchto   
			účastí a výsledků</p>   
		</li></ul>   
		</li><li>   
<p>registruje   
		se jako rozhodčí na turnaj, v&nbsp;kterém daný uživatel   
		nefiguruje jako hráč - stává se <b>rozhodčím turnaje</b></p>   
		<ul><li>   
<p>nezávisle   
			sleduje vybrané zápasy a zadává výsledky zápasů (výsledek   
			zápasu uvažujte jako dvojici (počet bodů týmu/hráče 1,   
			počet bodů týmu/hráče 2)) -    
			</p>   
			</li><li>   
<p>zadává   
			další statistiky zápasu (např. v&nbsp;tenisu získané gamy   
			apod.)</p>   
		</li></ul>   
		</li><li>   
<p>vytváří   
		turnaje - stává se <b>pořadatelem turnaje</b></p>   
		<ul><li>   
<p>spravuje   
			turnaj, stanovuje jejich požadavky a omezení (např. počet   
			hráčů týmu)</p>   
			</li><li>   
<p>potvrzuje   
			registrace hráčů a rozhodčích (na turnaj se může   
			registrovat více účastníků, pořadatel vybere)</p>   
			</li><li>   
<p>provádí   
			rozlosování zápasů turnaje</p>   
		</li></ul>   
	</li></ul>   
	</li><li>   
<p><b>neregistrovaný   
	návštěvník:</b></p>   
	<ul><li>   
<p>má   
		možnost procházet profily hráčů, týmů, existující turnaje   
		a výsledky turnajů</p>   
		</li><li>   
<p>má   
		možnost procházet jak statistiky turnajů, tak celkové   
		statistiky (např. počty vyhraných turnajů)</p>   
	</li></ul>   
</li></ul>   
<p>Každý   
registrovaný uživatel má možnost editovat svůj profil.</p><p><b>Typy na možná   
rozšíření:</b></p>   
<ul><li>   
<p>pořadatel   
	má možnost specifikovat herní systém (není omezeno pouze na   
	vyřazovací systém)</p>   
	</li><li>   
<p>podrobný   
	popis statistik a událostí zápasu, jednoduché zadávání těchto   
	událostí rozhodčím turnaje</p>
  </li></ul></td></tr></tbody></table>


# Nasazení

Linky s užitečnými informacemi

- https://www.digitalocean.com/community/tutorials/how-to-deploy-a-symfony-4-application-to-production-with-lemp-on-ubuntu-18-04

Each time you log in to the eva server, a brief instruction is shown; here is the summary:
Create a WWW directory: mkdir ~/WWW in the home directory
set permissions: chmod -R o=rX,g= ~/WWW (i.e. a permission to read and execute for everyone but prohibited writing and no group permissions)
set permissions for home directory as follows: chmod o=x ~
the WWW directory must contain a valid index.html or index.php file. HTML files must be readable "for everyone" - chmod o+r. PHP scripts are executed under your identity; therefore, they must be readable for owner (usually the default setting).
to check the permissions - example:
```
eva ~> chmod -R o=rX,g= WWW
eva ~> ls -ld WWW
drwx---r-x  2 xtest99  vti-fekt  512 21 oct 16:10 WWW
eva ~> ls -l WWW
total 0
-rw-r-----  1 xtest99  vti-fekt  0 21 oct 16:17 index.php
eva ~> chmod o+r WWW/index.php
eva ~> ls -l WWW
total 0
rw-r--r--  1 xtest99  vti-fekt  0 21 oct 16:17 index.php
```

.htaccess
 ```
DefaultCharset utf-8
AddHandler application/x-httpd-php72 .php
 ```

 .env
 ```
 APP_ENV=prod
 DATABASE_URL=mysql://xzales13:heslo@localhost/xzales13
 ```

install composer locally
```
php72 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php72 composer-setup.php
php72 -r "unlink('composer-setup.php');"
```

```
php bin/Console server:run
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
php bin/console doctrine:schema:update --force
chmod -R 755 ~/WWW/.*
```