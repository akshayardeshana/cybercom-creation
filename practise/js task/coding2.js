//coding challage 2
var john_team=112+12+12;
var mike_team=12+12+12;
var mary_team=12+12+12;
var avg_john=john_team/3;
var avg_mike=mike_team/3;
var avg_mary=mary_team/3;
if (avg_john>avg_mike && avg_john>avg_mary) 
{
    console.log("winner is john's team & score is",avg_john);
}
else if(avg_john==avg_mike && avg_john==avg_mary) {
    console.log("match is draw");    
}
else
{
    if(avg_mike>avg_mary)
    {
        console.log("winner is mike's team & score is",avg_mike);
    }
    else
    {
        console.log("winner is mary's team & score is",avg_mary);
    }    
}
