@extends('layout_pr')
@section('contenu')
<div class="container">
   <div class="row principal">
      <div class="col-lg-12" style="text-align: center;">
         <h1> Relations tâches/compétences</h1>
      </div>
      <form class="col-lg-12 text-center">
         <div class="col-lg-12 text-center">
            <input type="radio" class="choixref" name="choixref" value="cpi" checked>
            <label for="cpi">CPI</label>
            <input type="radio" class="choixref" name="choixref" value="cprp">
            <label for="cprp">CPRP</label>
         </div>
      </form>
      <table class="table table-responsive" id="tabcpi" style='border-collapse: collapse;table-layout:fixed;'>
         <tr>
            <td colspan=2 rowspan=2  class=activite>Relations entre les activités
               professionnelles et les compétences du BTS CPI
            </td>
            <td colspan=4 rowspan=2  class="titre jaunec"  >COMPETENCES TRANVERSALES</td>
            <td colspan=10 rowspan=2   class="titre rouge" >COMPETENCES CŒUR DE METIERS</td>
         </tr>
         <tr>
         </tr>
         <tr>
            <td class=tache >Activités</td>
            <td class=tache>Tâches</td>
            <td class="tache jaunec" >C1</td>
            <td class="tache jaunec" >C2</td>
            <td class="tache jaunec" >C3</td>
            <td class="tache jaunec" >C4</td>
            <td class="tache rouge">C5</td>
            <td class="tache rouge" >C6</td>
            <td class="tache rouge" >C7</td>
            <td class="tache rouge" >C8</td>
            <td class="tache rouge" >C9</td>
            <td class="tache rouge" >C10</td>
            <td class="tache rouge" >C11</td>
            <td class="tache rouge" >C12</td>
            <td class="tache rouge" >C13</td>
            <td class="tache rouge" >C14</td>
         </tr>
         <tr>
            <td rowspan=4  class="bleuc activite"   >Participer à la réponse à une affaire : analyser
               l'expression d'un besoin et rédiger un CdCf<span
                  > </span>
            </td>
            <td class=tache >A1-T1</td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A1-T2</td>
            <td></td>
            <td class=bleuc >3</td>
            <td></td>
            <td>1</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A1-T3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr >
            <td class=tache >A1-T4</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td>1</td>
            <td>2</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td rowspan=7  class="gris activite"   >Conception préliminaire :
               concevoir et choisir une solution technique relative à un mécanisme<span
                  > </span>
            </td>
            <td class=tache>A2-T1</td>
            <td></td>
            <td>2</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T2</td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=gris >3</td>
            <td></td>
            <td class=gris >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T3</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td class=gris >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=gris >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T6</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td>1</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr >
            <td class=tache >A2-T7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td class=gris >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td rowspan=9  class="activite jaune"   >Conception détaillée :
               pré-industrialiser et définir une solution technique optimisée relative à un
               mécanisme<span > </span>
            </td>
            <td class=tache>A3-T1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>1</td>
         </tr>
         <tr>
            <td class=tache >A3-T2</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td class=jaune >3</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td class=jaune >3</td>
            <td>2</td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td class=jaune >3</td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=jaune >3</td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
         </tr>
         <tr>
            <td class=tache >A3-T6</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >3</td>
         </tr>
         <tr>
            <td class=tache >A3-T7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=jaune >3</td>
            <td>1</td>
         </tr>
         <tr>
            <td class=tache >A3-T8</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >3</td>
         </tr>
         <tr>
            <td class=tache >A3-T9</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
         </tr>
         <tr>
            <td rowspan=3 height=61 class="activite vert"   style='border-bottom:1.0pt solid black;
               '>Participer à la vie d’un bureau d’études<span
               > </span></td>
            <td class=tache>A4-T1</td>
            <td class=vert >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A4-T2</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr  >
            <td class=tache >A4-T3</td>
            <td></td>
            <td></td>
            <td class=vert >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr  >
            <td colspan=2 align=left>Epreuves de certification</td>
            <td colspan=14 ></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve bleuc" >U41-Expression du besoin et CdCf</td>
            <td></td>
            <td class=bleuc >C2</td>
            <td></td>
            <td></td>
            <td class=bleuc>C5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve gris" >U42-Conception préliminaire</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=gris >C6</td>
            <td></td>
            <td class=gris >C8</td>
            <td class=gris >C9</td>
            <td class=gris >C10</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class=" epreuve vert" >U52-Soutenance du rapport de stage</td>
            <td class=vert >C1</td>
            <td></td>
            <td class=vert >C3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve jaune" >U51-Conception détaillée</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >C7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >C12</td>
            <td></td>
            <td class=jaune >C14</td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve jaune" >U61-Projet de prototypage</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >C13</td>
            <td></td>
         </tr>
         <tr  >
            <td colspan=2  class="epreuve jaune" >U62-Projet collaboratif d'optimisation</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >C4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=jaune >C11</td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
      </table>
      <table class="table table-responsive" id="tabcprp"  style='border-collapse: collapse;table-layout:fixed; ' >
         <tr>
            <td colspan=2 rowspan=2  class=activite  >Relations entre les activités
               professionnelles et les compétences du BTS CPRP
            </td>
            <td colspan=4 rowspan=2  class="titre jaunec" >COMPETENCES TRANVERSALES</td>
            <td colspan=14 rowspan=2   class="titre rouge"  >COMPETENCES CŒUR DE METIERS</td>
         </tr>
         <tr>
         </tr>
         <tr>
            <td class=tache >Activités</td>
            <td class=tache>Tâches</td>
            <td class="tache jaunec" >C1</td>
            <td class="tache jaunec" >C2</td>
            <td class="tache jaunec" >C3</td>
            <td class="tache jaunec" >C4</td>
            <td class="tache rouge">C5</td>
            <td class="tache rouge" >C6</td>
            <td class="tache rouge" >C7</td>
            <td class="tache rouge" >C8</td>
            <td class="tache rouge" >C9</td>
            <td class="tache rouge" >C10</td>
            <td class="tache rouge" >C11</td>
            <td class="tache rouge" >C12</td>
            <td class="tache rouge" >C13</td>
            <td class="tache rouge" >C14</td>
            <td class="tache rouge" >C15</td>
            <td class="tache rouge" >C16</td>
            <td class="tache rouge" >C17b</td>
            <td class="tache rouge" >C18b</td>
         </tr>
         <tr>
            <td rowspan=5  class="bleuc activite"  >Répondre à une affaire</td>
            <td class=tache >A1-T1</td>
            <td>1</td>
            <td class=bleuc>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>3</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A1-T2</td>
            <td>1</td>
            <td>2</td>
            <td>2</td>
            <td class=bleuc>3</td>
            <td></td>
            <td>1</td>
            <td>1</td>
            <td class=bleuc>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A1-T3</td>
            <td class=bleuc>3</td>
            <td>1</td>
            <td class=bleuc>3</td>
            <td class=bleuc>3</td>
            <td></td>
            <td>1</td>
            <td class=bleuc>3</td>
            <td></td>
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A1-T4</td>
            <td>2</td>
            <td>2</td>
            <td class=bleuc >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr >
            <td class=tache >A1-T5</td>
            <td  class=bleuc>3</td>
            <td></td>
            <td class=bleuc>3</td>
            <td></td>
            <td></td>
            <td>1</td>
            <td>1</td>
            <td  class=bleuc>3</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td rowspan=6  class="vert activite"  >Concevoir la production</td>
            <td class=tache>A2-T1</td>
            <td>2</td>
            <td class=vert>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td class=vert>3</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T2</td>
            <td>2</td>
            <td class=vert>3</td>
            <td></td>
            <td></td>
            <td class=vert>3</td>
            <td>1</td>
            <td></td>
            <td>2</td>
            <td class=vert>3</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=vert>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T4</td>
            <td>1</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=vert>3</td>
            <td>1</td>
            <td class=vert >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T5</td>
            <td>2</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=vert>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A2-T6</td>
            <td class=vert>3</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
         </tr>
         <tr>
            <td rowspan=5  class="activite violet"  >Initialiser la production</td>
            <td class=tache>A3-T1</td>
            <td class=violet>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=violet>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
         </tr>
         <tr>
            <td class=tache >A3-T2</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=violet>3</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T3</td>
            <td class=violet>3</td>
            <td></td>
            <td>2</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=violet>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td class=violet>3</td>
            <td></td>
            <td></td>
            <td ></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A3-T5</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>1</td>
            <td></td>
            <td class=violet>3</td>
            <td></td>
         </tr>
         <tr>
            <td rowspan=7  class="activite orange"  >Gérer la réalisation</td>
            <td class=tache>A4-T1</td>
            <td>2</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=orange>3</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A4-T2</td>
            <td>2</td>
            <td></td>
            <td>1</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td class=orange>3</td>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A4-T3</td>
            <td>2</td>
            <td></td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=orange>3</td>
            <td></td>
            <td></td>
            <td class=orange>3</td>
         </tr>
         <tr>
            <td class=tache >A4-T4</td>
            <td>2</td>
            <td></td>
            <td>2</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>2</td>
            <td></td>
            <td>1</td>
            <td class=orange>3</td>
            <td>1</td>
            <td></td>
         </tr>
         <tr  >
            <td class=tache >A4-T5</td>
            <td></td>
            <td class=orange >3</td>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=orange>3</td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A4-T6</td>
            <td></td>
            <td></td>
            <td class=orange >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td class=tache >A4-T7</td>
            <td class=orange >3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 align=left>Epreuves de certification</td>
            <td colspan=18 ></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve bleuc" >U4 - Conception préliminaire </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td ></td>
            <td class=bleuc>C6</td>
            <td></td>
            <td class=bleuc>C8</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve vert" >U5 - Projet industriel</td>
            <td></td>
            <td class=vert>C2</td>
            <td></td>
            <td></td>
            <td class=vert>C5</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=vert>C9</td>
            <td class=vert >C10</td>
            <td class=vert>C11</td>
            <td></td>
            <td class=violet >C13</td>
            <td class=violet >C14</td>
            <td></td>
            <td></td>
            <td class=violet>Cb17</td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class=" epreuve bleuc" >U61 - Projet collaboratif</td>
            <td></td>
            <td></td>
            <td></td>
            <td class=bleuc>C4</td>
            <td></td>
            <td></td>
            <td class=bleuc>C7</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td colspan=2 class="epreuve orange" >U62 - Gestion et suivi de réalisation en entreprise</td>
            <td class=orange>C1</td>
            <td></td>
            <td class=orange>C3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class=orange>C12</td>
            <td></td>
            <td></td>
            <td class=orange>C15</td>
            <td class=orange >C16</td>
            <td></td>
            <td class=orange >Cb18</td>
         </tr>
      </table>
   </div>
</div>
@endsection