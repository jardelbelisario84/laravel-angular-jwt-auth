import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { AuthService } from './services/auth.service';

import { LoginComponent } from './login/login.component';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  imports: [
  CommonModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  declarations: [
    LoginComponent
  ],
  providers: [
    AuthService
  ]
})
export class AuthModule { }
