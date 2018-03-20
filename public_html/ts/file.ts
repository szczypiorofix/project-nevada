/**
 * https://code.tutsplus.com/series/typescript-for-beginners--cms-1215
 */


 class MyClass {
     powitanie: string;

     constructor (msg: string) {
         this.powitanie = msg;
     }

     show():void {
         console.log(this.powitanie);
     }
 }

 let myObj = new MyClass("To jest powitanie!");
 myObj.show();

