import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { environment } from './../../../environments/environment.prod';

import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/do';

@Injectable()
export class AuthService {

  public credentials: {
    email: string,
    password: string
  };

  constructor(private http: HttpClient) { }

  check(): boolean {
    return localStorage.getItem('user') ? true : false;
  }

  login(credentials): Observable<boolean> {
    return this.http.post<any>(`${environment.api_url}/auth/login`, credentials)
    .do( data => {
      localStorage.setItem('token', data.token);
      localStorage.setItem('user', btoa(JSON.stringify(data.user)));
    });
  }
}
