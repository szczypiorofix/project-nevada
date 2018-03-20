/**
 * https://code.tutsplus.com/series/typescript-for-beginners--cms-1215
 */
var MyClass = /** @class */ (function () {
    function MyClass(msg) {
        this.powitanie = msg;
    }
    MyClass.prototype.show = function () {
        console.log(this.powitanie);
    };
    return MyClass;
}());
var myObj = new MyClass("To jest powitanie!");
myObj.show();
//# sourceMappingURL=file.js.map