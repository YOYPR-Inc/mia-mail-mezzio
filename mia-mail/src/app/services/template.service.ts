import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthenticationService, MiaAuthHttpService } from '@mobileia/authentication';

@Injectable({
  providedIn: 'root'
})
export class TemplateService extends MiaAuthHttpService {

  baseUrl = '';

  constructor(
    protected http: HttpClient,
    protected authService: AuthenticationService
  ) {
    super(http, authService);
  }

  fetchAllTemplates(): Promise<any> {
    return this.postAuthObjectPro(this.baseUrl + 'mia-mail/templates', { });
  }
}
