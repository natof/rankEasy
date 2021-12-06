<h1 align="center">RankEasy</h1>
<p align="center">
  <img width="250" height="250" src="https://github.com/natof/rankEasy/blob/main/icon.png">
</p>  

<h2 align="center">Simple plugin to create ranks 🎈</h2>

<h3>Config:</h3>

``` yaml
# YAML
default: "member" #The default rank in server

grade:
  member: #the name of the rank
    colorGrade: "§8" #Color of rank
    colorChat: "§7" #Color in chat
    permission: [] 

  admin: 
    colorRank: "§6"
    colorChat: "§f"
    permission: [
    "grade.use" #add Permission 
    ]
```

<h4>Command: /setgrade {player} {grade}</h4>
