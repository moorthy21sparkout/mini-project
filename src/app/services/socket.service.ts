import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { io } from 'socket.io-client';

@Injectable({
  providedIn: 'root'
})
export class SocketService {
  private socket = io()
  constructor() { }

  getMessages(){
    return new Observable(observe =>{
      this.socket.on("message",(message)=>{
        observe.next(message);
      })

      return ()=>{
        this.socket.disconnect();
      }
    })
  }
}
