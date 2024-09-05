import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { MessageService } from './services/message.service';
import { SocketService } from './services/socket.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet,ReactiveFormsModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit{
  title = 'socket-angular';

  form!:FormGroup;
  messages:string[]=[];

  constructor(private formbuilder:FormBuilder,private messageService:MessageService,private socketService:SocketService){
    this.form = this.formbuilder.group({
      message:''
    }) 
  }
  ngOnInit(){
   this.socketService.getMessages().subscribe((message:any) =>{
    this.messages.push(message)
   })
  }
  onSubmit(){
    console.log(this.form.getRawValue());
    this.messageService.create(this.form.getRawValue()).subscribe({
      next: (responce)=> {
        console.log(responce);
      },
      error:err=>{
        console.log(err);
        
      }
    })
    
  }
}
