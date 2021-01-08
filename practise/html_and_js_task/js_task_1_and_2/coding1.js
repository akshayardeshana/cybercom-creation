//coding challange 1
//BMI=mass/(height*height) where height in meter and mass in kg
var mark_height,mark_mass,john_height,john_mass;
mark_height=5;
mark_mass=90;
john_height=6;
john_mass=60;
var BMI=(mark_mass/(mark_height*mark_height))>(john_mass/(john_height*john_height));
console.log("Is mark's BMI higher than john's?",BMI);